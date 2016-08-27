<?php

$router->group(['prefix' => 'admin/academic', 'middleware' => ['authorize'], 'namespace' => 'Academic'], function($router){

    $router->get('subject/datatables', ['uses' => 'SubjectController@datatables', 'as' => 'admin.academic.subject.datatables']);
    $router->post('subject/import', ['uses' => 'SubjectController@import', 'as' => 'admin.academic.subject.import']);
    $router->get('subject/search', ['uses' => 'SubjectController@search', 'as' => 'admin.academic.subject.search']);
    $router->delete('subject/{ids}', ['uses' => 'SubjectController@destroy', 'as' => 'admin.academic.subject.destroy']);
    $router->resource('subject', 'SubjectController', ['except' => [ 'destroy', 'show']]);

    $router->get('class/datatables', ['uses' => 'ClassController@datatables', 'as' => 'admin.academic.class.datatables']);
    $router->post('class/import', ['uses' => 'ClassController@import', 'as' => 'admin.academic.class.import']);
    $router->get('class/search', ['uses' => 'ClassController@search', 'as' => 'admin.academic.class.search']);
    $router->delete('class/{ids}', ['uses' => 'ClassController@destroy', 'as' => 'admin.academic.class.destroy']);
    $router->resource('class', 'ClassController', ['except' => [ 'destroy', 'show']]);

    $router->get('study-plan', ['uses' => 'StudyPlanController@index', 'as' => 'admin.academic.study-plan.index']);

    $router->get('study-plan/assigned-student', ['uses' => 'StudyPlanController@getAssignedDatatables', 'as' => 'admin.academic.study-plan.assigned-student']);

    $router->get('study-plan/unassigned-student', ['uses' => 'StudyPlanController@getUnassignedDatatables', 'as' => 'admin.academic.study-plan.unassigned-student']);
});