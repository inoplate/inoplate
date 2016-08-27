<?php

namespace App\Http\Controllers\Master;

use App\Master\District;
use Inoplate\Foundation\Http\Controllers\Controller;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Bus;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class DistrictController extends Controller
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

        if($this->authis->check('admin.master.district.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.master.district.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('master.district.index', compact('actions'));
    }

    public function datatables(Request $request, Dales $dales)
    {
        $district = new District;
        $district->setDtModel(District::with('province.country'));

        return $dales->setDTDataProvider($district)
                     ->addColumn('province', function($data){
                        return $data['province']['name'];
                     })
                     ->addColumn('country', function($data){
                        return $data['province']['country']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.master.district.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.master.district.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function create()
    {
        return $this->getResponse('master.district.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:districts',
            'province_id' => 'required|exists:provinces,id'
        ]);

        $district = new District;
        $district->name = $request->name;
        $district->province_id = $request->province_id;

        $district->save();

        return $this->formSuccess(
            route('admin.master.district.index', ['id' => $district->id]), 
            [
                'message' => 'Kab/Kota berhasil disimpan', 
                'district' => $district
            ]
        );
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = District::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function show(District $district)
    {
        return $this->getResponse('master.district.show', compact('district'));
    }

    public function edit(District $district)
    {
        $province = $district->province;
        return $this->getResponse('master.district.edit', compact('district', 'province'));
    }

    public function update(Request $request, District $district)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:districts,name,'.$district->id,
            'province_id' => 'required|exists:provinces,id'
        ]);

        $district->name = $request->name;
        $district->province_id = $request->province_id;
        $district->save();

        return $this->formSuccess(
            route(
                'admin.master.district.index'), 
                ['message' => 'Kab/Kota berhasil disimpan ', 'district' => $district]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        District::destroy($ids);

        return $this->formSuccess(
            route('admin.master.district.index'), 
            ['message' => 'Kab/Kota berhasil dihapus']
        );
    }
}