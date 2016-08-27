<?php

namespace App\Http\Controllers\Institute;

use App\Institute\AcademicYear;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
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

        if($this->authis->check('admin.institute.academic-year.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.institute.academic-year.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('institute.academic-year.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        return $dales->setDTDataProvider(new AcademicYear)
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.institute.academic-year.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.institute.academic-year.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = AcademicYear::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('institute.academic-year.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:academic_years',
            'code' => 'required|max:255|unique:academic_years',
        ]);

        $academicYear = new AcademicYear;
        $academicYear->name = $request->name;
        $academicYear->code = $request->code;

        $academicYear->save();

        return $this->formSuccess(
            route('admin.institute.academic-year.index', ['id' => $academicYear->id]), 
            [
                'message' => 'Periode akademik berhasil disimpan', 
                'academicYear' => $academicYear
            ]
        );
    }

    public function show(AcademicYear $academicYear)
    {
        return $this->getResponse('institute.academic-year.show', compact('academicYear'));
    }

    public function edit(AcademicYear $academicYear)
    {
        return $this->getResponse('institute.academic-year.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:academic_years,name,'.$academicYear->id,
            'code' => 'required|max:255|unique:academic_years,code,'.$academicYear->id
        ]);

        $academicYear->name = $request->name;
        $academicYear->code = $request->code;
        $academicYear->save();

        return $this->formSuccess(
            route(
                'admin.institute.academic-year.index'), 
                ['message' => 'Periode akademik berhasil disimpan ', 'academicYear' => $academicYear]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        AcademicYear::destroy($ids);

        return $this->formSuccess(
            route('admin.institute.academic-year.index'), 
            ['message' => 'Periode akademik berhasil dihapus']
        );
    }
}