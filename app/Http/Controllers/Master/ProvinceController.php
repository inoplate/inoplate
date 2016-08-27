<?php

namespace App\Http\Controllers\Master;

use App\Master\Province;
use Inoplate\Foundation\Http\Controllers\Controller;
use Inoplate\Foundation\App\Services\Bus\Dispatcher as Bus;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class ProvinceController extends Controller
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

        if($this->authis->check('admin.master.province.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.master.province.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('master.province.index', compact('actions'));
    }

    public function datatables(Request $request, Dales $dales)
    {
        $province = new Province;
        $province->setDtModel(Province::with('country'));

        return $dales->setDTDataProvider($province)
                     ->addColumn('country', function($data){
                        return $data['country']['name'];
                     })
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.master.province.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.master.province.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function create()
    {
        return $this->getResponse('master.province.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:provinces',
            'country_id' => 'required|exists:countries,id'
        ]);

        $province = new Province;
        $province->name = $request->name;
        $province->country_id = $request->country_id;

        $province->save();

        return $this->formSuccess(
            route('admin.master.province.index', ['id' => $province->id]), 
            [
                'message' => 'Propinsi berhasil disimpan', 
                'province' => $province
            ]
        );
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Province::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function show(Province $province)
    {
        return $this->getResponse('master.province.show', compact('province'));
    }

    public function edit(Province $province)
    {
        $country = $province->country;

        return $this->getResponse('master.province.edit', compact('province', 'country'));
    }

    public function update(Request $request, Province $province)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:countries,name,'.$province->id,
            'country_id' => 'required|exists:countries,id'
        ]);

        $province->name = $request->name;
        $province->country_id = $request->country_id;
        $province->save();

        return $this->formSuccess(
            route(
                'admin.master.province.index'), 
                ['message' => 'Propinsi berhasil disimpan ', 'province' => $province]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Province::destroy($ids);

        return $this->formSuccess(
            route('admin.master.province.index'), 
            ['message' => 'Propinsi berhasil dihapus']
        );
    }
}