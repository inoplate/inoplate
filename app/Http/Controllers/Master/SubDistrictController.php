<?php

namespace App\Http\Controllers\Master;

use App\Master\SubDistrict;
use Inoplate\Foundation\Http\Controllers\Controller;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Bus;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class SubDistrictController extends Controller
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

        if($this->authis->check('admin.master.sub-district.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.master.sub-district.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('master.sub-district.index', compact('actions'));
    }

    public function datatables(Request $request, Dales $dales)
    {
        $subDistrict = new SubDistrict;
        $subDistrict->setDtModel(SubDistrict::with('district.province.country'));

        return $dales->setDTDataProvider($subDistrict)
                     ->addColumn('district', function($data){
                        return $data['district']['name'];
                     })
                     ->addColumn('province', function($data){
                        return $data['district']['province']['name'];
                     })
                     ->addColumn('country', function($data){
                        return $data['district']['province']['country']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.master.sub-district.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.master.sub-district.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function create()
    {
        return $this->getResponse('master.sub-district.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:sub_districts',
            'district_id' => 'required|exists:districts,id'
        ]);

        $subDistrict = new SubDistrict;
        $subDistrict->name = $request->name;
        $subDistrict->district_id = $request->district_id;

        $subDistrict->save();

        return $this->formSuccess(
            route('admin.master.sub-district.index', ['id' => $subDistrict->id]), 
            [
                'message' => 'Kecamatan berhasil disimpan', 
                'subDistrict' => $subDistrict
            ]
        );
    }

    public function show(SubDistrict $subDistrict)
    {
        return $this->getResponse('master.sub-district.show', compact('subDistrict'));
    }

    public function edit(SubDistrict $subDistrict)
    {
        $district = $subDistrict->district;
        return $this->getResponse('master.sub-district.edit', compact('subDistrict', 'district'));
    }

    public function update(Request $request, SubDistrict $subDistrict)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:sub_districts,name,'.$subDistrict->id,
            'district_id' => 'required|exists:districts,id'
        ]);

        $subDistrict->name = $request->name;
        $subDistrict->district_id = $request->district_id;
        $subDistrict->save();

        return $this->formSuccess(
            route(
                'admin.master.sub-district.index'), 
                ['message' => 'Kecamatan berhasil disimpan ', 'subDistrict' => $subDistrict]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        SubDistrict::destroy($ids);

        return $this->formSuccess(
            route('admin.master.sub-district.index'), 
            ['message' => 'Kecamatan berhasil dihapus']
        );
    }
}