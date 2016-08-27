<?php

namespace App\Http\Controllers\Employee;

use App\Employee\Lecturer;
use App\Institute\Program;
use Inoplate\Foundation\Http\Controllers\Controller;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Bus;
use Inoplate\Account\Domain\Repositories\User as UserRepository;
use Inoplate\Account\Domain\Commands\RegisterNewUser;
use Inoplate\Account\Role;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    protected $authis;

    public function __construct(Authis $authis)
    {
        $this->authis = $authis;
    }

    public function index(Lecturer $lecturer)
    {
        $actions['active'] = [];
        $actions['trashed'] = [];

        if($this->authis->check('admin.employee.lecturer.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.employee.lecturer.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('employee.lecturer.index', compact('actions'));
    }

    public function import(Request $request, UserRepository $userRepository, Bus $bus)
    {
        $filename = $request->file;
        $programId = $request->program_id;

        \Excel::load('storage/app/' . $filename, function($reader) use ($programId, $userRepository, $bus){
            $sheets = $reader->all();

            $sheets->each(function($sheet) use ($programId, $userRepository, $bus){
                $sheet->each(function($row) use ($programId, $userRepository, $bus){
                    $lecturer = Lecturer::firstOrNew(['reg_no' => $row->nidn_nup_nidk]);
                    $lecturer->local_reg_no = $row->nip;
                    $lecturer->name = $row->nama;

                    $user = $userRepository->findByUsername($lecturer->reg_no);

                    if(!$user) {
                        $role = Role::where('name', 'Lecturer')->first();
                        $roles = $role ? [$role->id] : [];

                        $desc = [ 
                            'password' => bcrypt($lecturer->reg_no), 
                            'name' => $lecturer->name, 
                            'active' => true
                        ];

                        $bus->dispatch( new RegisterNewUser($lecturer->reg_no, $lecturer->reg_no.'@email.com', $roles, $desc) );

                        $user = $userRepository->findByUsername($lecturer->reg_no);
                    }

                    $lecturer->user_id = $user->id()->value();
                    $lecturer->save();
                });
            });
        });

        return $this->formSuccess(
            route(
                'admin.employee.lecturer.index'), 
                ['message' => 'Import dosen berhasil']);
    }

    public function datatables(Dales $dales, Request $request)
    {
        $programId = $request->get('program_id');
        $entryYear = $request->get('entry_year');
        $status = $request->get('status');

        $lecturer = new Lecturer;
        $lecturer->setDTModel(
            Lecturer::with(['country'])
                    ->ofStatus($status)
        );

        return $dales->setDTDataProvider($lecturer)
                     ->addColumn('program', function($data) {
                        return $data['program']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.employee.lecturer.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.employee.lecturer.destroy'))
                            $actions[] = 'delete';

                        if($this->authis->check('admin.employee.lecturer.show'))
                            $actions[] = 'show';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Lecturer::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('employee.lecturer.create');
    }

    public function store(Request $request, Bus $bus, UserRepository $userRepository)
    {
        $this->validate($request, [
            'reg_no' => 'required|max:255|unique:lecturers',
            'local_reg_no' => 'required|max:255|unique:lecturers',
            'name' => 'required|max:255',
            'id_number' => 'unique:lecturers',
            'country_id' => 'exists:countries,id',
        ]);

        $lecturer = new Lecturer;
        $lecturer->reg_no = $request->reg_no;
        $lecturer->local_reg_no = $request->local_reg_no;
        $lecturer->name = $request->name;
        $lecturer->status = $request->status;
        $lecturer->id_number = $request->id_number;
        $lecturer->mother_maiden_name = $request->mother_maiden_name;
        $lecturer->country_id = $request->country_id;
        $lecturer->avatar = $request->avatar;

        $user = $userRepository->findByUsername($request->reg_no);

        if(!$user) {
            $role = Role::where('name', 'Lecturer')->first();
            $roles = $role ? [$role->id] : [];

            $desc = [ 
                'password' => bcrypt($request->reg_no), 
                'name' => $request->name, 
                'active' => true
            ];

            $bus->dispatch( new RegisterNewUser($request->reg_no, $request->reg_no.'@email.com', $roles, $desc) );

            $user = $userRepository->findByUsername($request->reg_no);
        }

        $lecturer->user_id = $user->id()->value();

        $lecturer->save();

        return $this->formSuccess(
            route('admin.employee.lecturer.index', ['id' => $lecturer->id]), 
            [
                'message' => 'Dosen berhasil disimpan', 
                'lecturer' => $lecturer
            ]
        );
    }

    public function show(Lecturer $lecturer)
    {
        return $this->getResponse('employee.lecturer.show', compact('lecturer'));
    }

    public function edit(Lecturer $lecturer)
    {
        return $this->getResponse('employee.lecturer.edit', compact('lecturer'));
    }

    public function update(Request $request, Lecturer $lecturer)
    {
        $this->validate($request, [
            'reg_no' => 'required|max:255|unique:lecturers,reg_no,'.$lecturer->id,
            'local_reg_no' => 'required|max:255|unique:lecturers,local_reg_no,'.$lecturer->id,
            'name' => 'required|max:255',
            'id_number' => 'unique:lecturers,id_number,'.$lecturer->id,
            'country_id' => 'exists:countries,id',
        ]);

        $lecturer->reg_no = $request->reg_no;
        $lecturer->local_reg_no = $request->local_reg_no;
        $lecturer->name = $request->name;
        $lecturer->status = $request->status;
        $lecturer->id_number = $request->id_number;
        $lecturer->mother_maiden_name = $request->mother_maiden_name;
        $lecturer->country_id = $request->country_id;
        $lecturer->avatar = $request->avatar;

        $lecturer->save();

        return $this->formSuccess(
            route(
                'admin.employee.lecturer.index'), 
                ['message' => 'Dosen berhasil disimpan ', 'lecturer' => $lecturer]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Lecturer::destroy($ids);

        return $this->formSuccess(
            route('admin.employee.lecturer.index'), 
            ['message' => 'Dosen berhasil dihapus']
        );
    }
}