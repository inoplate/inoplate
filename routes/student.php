<?php

$router->group(['prefix' => 'admin/student', 'middleware' => ['authorize'], 'namespace' => 'Student'], function($router){

    $router->get('student/datatables', ['uses' => 'StudentController@datatables', 'as' => 'admin.student.student.datatables']);
    $router->post('student/import', ['uses' => 'StudentController@import', 'as' => 'admin.student.student.import']);
    $router->get('student/search', ['uses' => 'StudentController@search', 'as' => 'admin.student.student.search']);
    $router->delete('student/{ids}', ['uses' => 'StudentController@destroy', 'as' => 'admin.student.student.destroy']);
    $router->resource('student', 'StudentController', ['except' => [ 'destroy', 'show']]);
});