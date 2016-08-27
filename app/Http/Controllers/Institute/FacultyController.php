<?php

namespace App\Http\Controllers\Institute;

use App\Institute\Faculty;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class FacultyController extends Controller
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

        if($this->authis->check('admin.institute.faculty.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.institute.faculty.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('institute.faculty.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        return $dales->setDTDataProvider(new Faculty)
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.institute.faculty.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.institute.faculty.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Faculty::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('institute.faculty.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:faculties',
            'code' => 'required|max:255|unique:faculties',
        ]);

        $faculty = new Faculty;
        $faculty->name = $request->name;
        $faculty->code = $request->code;

        $faculty->save();

        return $this->formSuccess(
            route('admin.institute.faculty.index', ['id' => $faculty->id]), 
            [
                'message' => 'Fakultas berhasil disimpan', 
                'faculty' => $faculty
            ]
        );
    }

    public function show(Faculty $faculty)
    {
        return $this->getResponse('institute.faculty.show', compact('faculty'));
    }

    public function edit(Faculty $faculty)
    {
        return $this->getResponse('institute.faculty.edit', compact('faculty'));
    }

    public function update(Request $request, Faculty $faculty)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:faculties,name,'.$faculty->id,
            'code' => 'required|max:255|unique:faculties,code,'.$faculty->id
        ]);

        $faculty->name = $request->name;
        $faculty->code = $request->code;
        $faculty->save();

        return $this->formSuccess(
            route(
                'admin.institute.faculty.index'), 
                ['message' => 'Fakultas berhasil disimpan ', 'faculty' => $faculty]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Faculty::destroy($ids);

        return $this->formSuccess(
            route('admin.institute.faculty.index'), 
            ['message' => 'Fakultas berhasil dihapus']
        );
    }
}