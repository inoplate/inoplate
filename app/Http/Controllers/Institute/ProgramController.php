<?php

namespace App\Http\Controllers\Institute;

use App\Institute\Program;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    protected $authis;

    public function __construct(Authis $authis)
    {
        $this->authis = $authis;
    }

    public function index()
    {
        $actions['active'] = [];
        $actions['trashed'] = [];

        if($this->authis->check('admin.institute.program.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.institute.program.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('institute.program.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        $program = new Program;
        $program->setDTModel(Program::with('department.faculty'));

        return $dales->setDTDataProvider($program)
                     ->addColumn('department', function($data) {
                        return $data['department']['name'];
                     })
                     ->addColumn('faculty', function($data) {
                        return $data['department']['faculty']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.institute.program.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.institute.program.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Program::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('institute.program.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:programs',
            'code' => 'required|max:255|unique:programs',
            'department_id' => 'required|exists:departments,id',
        ]);

        $program = new Program;
        $program->name = $request->name;
        $program->code = $request->code;
        $program->department_id = $request->department_id;

        $program->save();

        return $this->formSuccess(
            route('admin.institute.program.index', ['id' => $program->id]), 
            [
                'message' => 'Program studi berhasil disimpan', 
                'program' => $program
            ]
        );
    }

    public function show(Program $program)
    {
        return $this->getResponse('institute.program.show', compact('program'));
    }

    public function edit(Program $program)
    {
        $department = $program->department;

        return $this->getResponse('institute.program.edit', compact('program', 'department'));
    }

    public function update(Request $request, Program $program)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:programs,name,'.$program->id,
            'code' => 'required|max:255|unique:programs,code,'.$program->id,
            'department_id' => 'required|exists:departments,id',
        ]);

        $program->name = $request->name;
        $program->code = $request->code;
        $program->department_id = $request->department_id;
        $program->save();

        return $this->formSuccess(
            route(
                'admin.institute.program.index'), 
                ['message' => 'Program studi berhasil disimpan ', 'program' => $program]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Program::destroy($ids);

        return $this->formSuccess(
            route('admin.institute.program.index'), 
            ['message' => 'Program studi berhasil dihapus']
        );
    }
}