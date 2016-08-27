<?php

namespace App\Http\Controllers\Institute;

use App\Institute\Department;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class DepartmentController extends Controller
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

        if($this->authis->check('admin.institute.department.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.institute.department.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('institute.department.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        $department = new Department;
        $department->setDTModel(Department::with('faculty'));

        return $dales->setDTDataProvider($department)
                     ->addColumn('faculty', function($data) {
                        return $data['faculty']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.institute.department.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.institute.department.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Department::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('institute.department.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:departments',
            'code' => 'required|max:255|unique:departments',
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $department = new Department;
        $department->name = $request->name;
        $department->code = $request->code;
        $department->faculty_id = $request->faculty_id;

        $department->save();

        return $this->formSuccess(
            route('admin.institute.department.index', ['id' => $department->id]), 
            [
                'message' => 'Jurusan berhasil disimpan', 
                'department' => $department
            ]
        );
    }

    public function show(Department $department)
    {
        return $this->getResponse('institute.department.show', compact('department'));
    }

    public function edit(Department $department)
    {
        $faculty = $department->faculty;

        return $this->getResponse('institute.department.edit', compact('department', 'faculty'));
    }

    public function update(Request $request, Department $department)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:departments,name,'.$department->id,
            'code' => 'required|max:255|unique:departments,code,'.$department->id,
            'faculty_id' => 'required|exists:faculties,id',
        ]);

        $department->name = $request->name;
        $department->code = $request->code;
        $department->faculty_id = $request->faculty_id;
        $department->save();

        return $this->formSuccess(
            route(
                'admin.institute.department.index'), 
                ['message' => 'Jurusan berhasil disimpan ', 'department' => $department]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Department::destroy($ids);

        return $this->formSuccess(
            route('admin.institute.department.index'), 
            ['message' => 'Jurusan berhasil dihapus']
        );
    }
}