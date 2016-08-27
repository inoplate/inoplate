<?php

namespace App\Http\Controllers\Academic;

use App\Academic\ClassModel;
use App\Institute\AcademicYear;
use App\Student\Student;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class StudyPlanController extends Controller
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
        $classes = ClassModel::all();
        $academicYears = AcademicYear::all();

        if($this->authis->check('admin.academic.study-plan.map')) {
            $actions['active'][] = 'map';
        }

        return view('academic.study-plan.index', compact('actions', 'classes', 'academicYears'));
    }

    public function map(Request $request)
    {

    }

    public function getAssignedDatatables(Request $request, Dales $dales)
    {
        $classId = $request->input('class_id');
        $class = new ClassModel;
        $dtModel = ClassModel::with('students')->where('id', $classId);

        $class->setDtModel($dtModel);

        return $dales->setDTDataProvider($class)
                     ->addColumn('student_name', function($data){
                        return $data['student']['name'];
                     })
                     ->addColumn('student_id', function($data){
                        return $data['student']['id'];
                     })
                     ->addColumn('student_no_reg', function($data){
                        return $data['student']['no_reg'];
                     })
                     ->render();
    }

    public function getUnassignedDatatables(Dales $dales)
    {
        
    }
}