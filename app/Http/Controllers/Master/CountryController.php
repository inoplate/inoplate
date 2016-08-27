<?php

namespace App\Http\Controllers\Master;

use App\Master\Country;
use Inoplate\Foundation\Http\Controllers\Controller;
use Roseffendi\Dales\Dales;
use Roseffendi\Authis\Authis;
use Illuminate\Http\Request;

class CountryController extends Controller
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

        if($this->authis->check('admin.master.country.create')) {
            $actions['active'][] = 'create';
        }

        if($this->authis->check('admin.master.country.destroy')) {
            $actions['active'][] = 'delete';
        }

        return view('master.country.index', compact('actions'));
    }

    public function datatables(Dales $dales)
    {
        return $dales->setDTDataProvider(new Country)
                     ->addColumn('actions', function($data) {
                        $actions = [];

                        if($this->authis->check('admin.master.country.edit'))
                            $actions[] = 'update';

                        if($this->authis->check('admin.master.country.destroy'))
                            $actions[] = 'delete';

                        return $actions;
                     })
                     ->render();
    }

    public function search(Request $request)
    {   
        $search = $request->get('q');
        $page = $request->get('page');
        $results = Country::where('name', 'like', '%'.$search.'%')->take($page * 5)->simplePaginate(5);

        return $results;
    }

    public function create()
    {
        return $this->getResponse('master.country.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:countries',
        ]);

        $country = new Country;
        $country->name = $request->name;

        $country->save();

        return $this->formSuccess(
            route('admin.master.country.index', ['id' => $country->id]), 
            [
                'message' => 'Negara berhasil disimpan', 
                'country' => $country
            ]
        );
    }

    public function show(Country $country)
    {
        return $this->getResponse('master.country.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return $this->getResponse('master.country.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $this->validate($request, [
            'name' => 'required|max:255|unique:countries,name,'.$country->id
        ]);

        $country->name = $request->name;
        $country->save();

        return $this->formSuccess(
            route(
                'admin.master.country.index'), 
                ['message' => 'Negara berhasil disimpan ', 'country' => $country]);
    }

    public function destroy($ids)
    {
        $ids = explode(',', $ids);

        Country::destroy($ids);

        return $this->formSuccess(
            route('admin.master.country.index'), 
            ['message' => 'Negara berhasil dihapus']
        );
    }
}