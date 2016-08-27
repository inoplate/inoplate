<?php

namespace App\Http\Controllers\Student;

use App\Student\Student;
use App\Institute\Program;
use Inoplate\Foundation\Http\Controllers\Controller;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Bus;
use Inoplate\Account\Domain\Repositories\User as UserRepository;
use Inoplate\Account\Domain\Commands\RegisterNewUser;
use Inoplate\Account\Role;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $authis;

    public function __construct(Authis $authis)
    {
        $this->authis = $authis;
    }

    public function index(Student $student)
    {
        $actions['active'] = [];
        $actions['trashed'] = [];
        $programs = Program::all();
        $entryYears = $student->entryYear();

        if($this->authis->check('admin.student.student.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.student.student.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('student.student.index', compact('actions', 'programs', 'entryYears'));
    }

    public function import(Request $request, UserRepository $userRepository, Bus $bus)
    {
        $filename = $request->file;
        $programId = $request->program_id;

        \Excel::load('storage/app/' . $filename, function($reader) use ($programId, $userRepository, $bus){
            $sheets = $reader->all();

            $sheets->each(function($sheet) use ($programId, $userRepository, $bus){
                $sheet->each(function($row) use ($programId, $userRepository, $bus){
                    $student = Student::firstOrNew(['reg_no' => $row->nim]);
                    $student->name = $row->nama;
                    $student->entry_year = $row->tahun_masuk;
                    $student->program_id = $programId;

                    $user = $userRepository->findByUsername($student->reg_no);

                    if(!$user) {
                        $role = Role::where('name', 'Student')->first();
                        $roles = $role ? [$role->id] : [];

                        $desc = [ 
                            'password' => bcrypt($student->reg_no), 
                            'name' => $student->name, 
                            'active' => true
                        ];

                        $bus->dispatch( new RegisterNewUser($student->reg_no, $student->reg_no.'@email.com', $roles, $desc) );

                        $user = $userRepository->findByUsername($student->reg_no);
                    }

                    $student->user_id = $user->id()->value();
                    $student->save();
                });
            });
        });

        return $this->formSuccess(
            route(
                'admin.student.student.index'), 
                ['message' => 'Import mahasiswa berhasil']);
    }

    public function datatables(Dales $dales, Request $request)
    {
        $programId = $request->get('program_id');
        $entryYear = $request->get('entry_year');
        $status = $request->get('status');

        $student = new Student;
        $student->setDTModel(
            Student::with(['country', 'program'])
                    ->ofProgram($programId)
                    ->ofEntryYear($entryYear)
                    ->ofStatus($status)
        );

        return $dales->setDTDataProvider($student)
                     ->addColumn('program', function($data) {
                        return $data['program']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.student.student.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.student.student.destroy'))
                            $actions[] = 'delete';

                        if($this->authis->check('admin.student.student.show'))
                            $actions[] = 'show';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Student::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('student.student.create');
    }

    public function store(Request $request, Bus $bus, UserRepository $userRepository)
    {
        $this->validate($request, [
            'reg_no' => 'required|max:255|unique:students',
            'name' => 'required|max:255',
            'entry_year' => 'required',
            'program_id' => 'required|exists:programs,id',
            'id_number' => 'unique:students',
            'country_id' => 'exists:countries,id',
        ]);

        $student = new Student;
        $student->reg_no = $request->reg_no;
        $student->name = $request->name;
        $student->entry_year = $request->entry_year;
        $student->program_id = $request->program_id;
        $student->id_number = $request->id_number;
        $student->mother_maiden_name = $request->mother_maiden_name;
        $student->country_id = $request->country_id;
        $student->avatar = $request->avatar;

        $user = $userRepository->findByUsername($request->reg_no);

        if(!$user) {
            $role = Role::where('name', 'Student')->first();
            $roles = $role ? [$role->id] : [];

            $desc = [ 
                'password' => bcrypt($request->reg_no), 
                'name' => $request->name, 
                'active' => true
            ];

            $bus->dispatch( new RegisterNewUser($request->reg_no, $request->reg_no.'@email.com', $roles, $desc) );

            $user = $userRepository->findByUsername($request->reg_no);
        }

        $student->user_id = $user->id()->value();

        $student->save();

        return $this->formSuccess(
            route('admin.student.student.index', ['id' => $student->id]), 
            [
                'message' => 'Mahasiswa berhasil disimpan', 
                'student' => $student
            ]
        );
    }

    public function show(Student $student)
    {
        return $this->getResponse('student.student.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return $this->getResponse('student.student.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'reg_no' => 'required|max:255|unique:students,reg_no,'.$student->id,
            'name' => 'required|max:255',
            'entry_year' => 'required',
            'program_id' => 'required|exists:programs,id',
            'id_number' => 'unique:students,id_number,'.$student->id,
            'country_id' => 'exists:countries,id',
        ]);

        $student->reg_no = $request->reg_no;
        $student->name = $request->name;
        $student->entry_year = $request->entry_year;
        $student->program_id = $request->program_id;
        $student->id_number = $request->id_number;
        $student->mother_maiden_name = $request->mother_maiden_name;
        $student->country_id = $request->country_id;
        $student->avatar = $request->avatar;

        $student->save();

        return $this->formSuccess(
            route(
                'admin.student.student.index'), 
                ['message' => 'Mahasiswa berhasil disimpan ', 'student' => $student]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Student::destroy($ids);

        return $this->formSuccess(
            route('admin.student.student.index'), 
            ['message' => 'Mahasiswa berhasil dihapus']
        );
    }
}