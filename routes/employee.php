<?php

$router->group(['prefix' => 'admin/employee', 'middleware' => ['authorize'], 'namespace' => 'Employee'], function($router){

    $router->get('lecturer/datatables', ['uses' => 'LecturerController@datatables', 'as' => 'admin.employee.lecturer.datatables']);
    $router->post('lecturer/import', ['uses' => 'LecturerController@import', 'as' => 'admin.employee.lecturer.import']);
    $router->get('lecturer/search', ['uses' => 'LecturerController@search', 'as' => 'admin.employee.lecturer.search']);
    $router->delete('lecturer/{ids}', ['uses' => 'LecturerController@destroy', 'as' => 'admin.employee.lecturer.destroy']);
    $router->resource('lecturer', 'LecturerController', ['except' => [ 'destroy', 'show']]);
});