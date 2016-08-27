<?php

namespace App\Http\Controllers\Academic;

use App\Academic\ClassModel;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class ClassController extends Controller
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

        if($this->authis->check('admin.academic.class.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.academic.class.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('academic.class.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        $class = new ClassModel;
        $class->setDTModel(ClassModel::with('subject', 'lecturer', 'academicYear'));

        return $dales->setDTDataProvider($class)
                     ->addColumn('subject', function($data) {
                        return $data['subject']['name'];
                     })
                     ->addColumn('lecturer', function($data) {
                        return $data['lecturer']['name'];
                     })
                     ->addColumn('academic_year', function($data) {
                        return $data['academic_year']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.academic.class.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.academic.class.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = ClassModel::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('academic.class.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|max:255|unique:classes',
            'name' => 'required|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $class = new ClassModel;
        $class->code = $request->code;
        $class->name = $request->name;
        $class->subject_id = $request->subject_id;
        $class->lecturer_id = $request->lecturer_id;
        $class->academic_year_id = $request->academic_year_id;

        $class->save();

        return $this->formSuccess(
            route('admin.academic.class.index', ['id' => $class->id]), 
            [
                'message' => 'Kelas berhasil disimpan', 
                'class' => $class
            ]
        );
    }

    public function show(ClassModel $class)
    {
        return $this->getResponse('academic.class.show', compact('class'));
    }

    public function edit(ClassModel $class)
    {
        $subject = $class->subject;
        $lecturer = $class->lecturer;
        $academicYear = $class->academicYear;
        return $this->getResponse('academic.class.edit', compact('class', 'subject', 'lecturer', 'academicYear'));
    }

    public function update(Request $request, ClassModel $class)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'code' => 'required|max:255|unique:classes,code,'.$class->id,
            'subject_id' => 'required|exists:subjects,id',
            'lecturer_id' => 'required|exists:lecturers,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ]);

        $class->code = $request->code;
        $class->name = $request->name;
        $class->lecturer_id = $request->lecturer_id;
        $class->academic_year_id = $request->academic_year_id;
        $class->subject_id = $request->subject_id;

        $class->save();

        return $this->formSuccess(
            route(
                'admin.academic.class.index'), 
                ['message' => 'Kelas berhasil disimpan ', 'class' => $class]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        ClassModel::destroy($ids);

        return $this->formSuccess(
            route('admin.academic.class.index'), 
            ['message' => 'Kelas berhasil dihapus']
        );
    }
}