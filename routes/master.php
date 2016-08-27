<?php


$router->group(['prefix' => 'admin/master', 'middleware' => ['authorize'], 'namespace' => 'Master'], function($router) {
    $router->get('country/datatables', ['uses' => 'CountryController@datatables', 'as' => 'admin.master.country.datatables']);
    $router->get('country/search', ['uses' => 'CountryController@search', 'as' => 'admin.master.country.search']);
    $router->delete('country/{ids}', ['uses' => 'CountryController@destroy', 'as' => 'admin.master.country.destroy']);
    $router->resource('country', 'CountryController', ['except' => [ 'destroy', 'show']]);

    $router->get('province/datatables', ['uses' => 'ProvinceController@datatables', 'as' => 'admin.master.province.datatables']);
    $router->get('province/search', ['uses' => 'ProvinceController@search', 'as' => 'admin.master.province.search']);
    $router->delete('province/{ids}', ['uses' => 'ProvinceController@destroy', 'as' => 'admin.master.province.destroy']);
    $router->resource('province', 'ProvinceController', ['except' => [ 'destroy', 'show']]);

    $router->get('district/datatables', ['uses' => 'DistrictController@datatables', 'as' => 'admin.master.district.datatables']);
    $router->get('district/search', ['uses' => 'DistrictController@search', 'as' => 'admin.master.district.search']);
    $router->delete('district/{ids}', ['uses' => 'DistrictController@destroy', 'as' => 'admin.master.district.destroy']);
    $router->resource('district', 'DistrictController', ['except' => [ 'destroy', 'show']]);

    $router->get('sub-district/datatables', ['uses' => 'SubDistrictController@datatables', 'as' => 'admin.master.sub-district.datatables']);
    $router->delete('sub-district/{ids}', ['uses' => 'SubDistrictController@destroy', 'as' => 'admin.master.sub-district.destroy']);
    $router->resource('sub-district', 'SubDistrictController', ['except' => [ 'destroy', 'show'], 'parameters' => ['sub-district' => 'subDistrict']]);
});