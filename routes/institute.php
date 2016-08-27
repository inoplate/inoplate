<?php

$router->group(['prefix' => 'admin/institute', 'middleware' => ['authorize'], 'namespace' => 'Institute'], function($router){

        // Institut profile router
        $router->get('profile', ['uses' => 'ProfileController@getIndex', 'as' => 'institute.admin.profile.index.get']);
        $router->put('profile', ['uses' => 'ProfileController@putUpdate', 'as' => 'institute.admin.profile.update.put']);

        $router->get('faculty/datatables', ['uses' => 'FacultyController@datatables', 'as' => 'admin.institute.faculty.datatables']);
        $router->get('faculty/search', ['uses' => 'FacultyController@search', 'as' => 'admin.institute.faculty.search']);
        $router->delete('faculty/{ids}', ['uses' => 'FacultyController@destroy', 'as' => 'admin.institute.faculty.destroy']);
        $router->resource('faculty', 'FacultyController', ['except' => [ 'destroy', 'show']]);

        $router->get('department/datatables', ['uses' => 'DepartmentController@datatables', 'as' => 'admin.institute.department.datatables']);
        $router->get('department/search', ['uses' => 'DepartmentController@search', 'as' => 'admin.institute.department.search']);
        $router->delete('department/{ids}', ['uses' => 'DepartmentController@destroy', 'as' => 'admin.institute.department.destroy']);
        $router->resource('department', 'DepartmentController', ['except' => [ 'destroy', 'show']]);

        $router->get('program/datatables', ['uses' => 'ProgramController@datatables', 'as' => 'admin.institute.program.datatables']);
        $router->get('program/search', ['uses' => 'ProgramController@search', 'as' => 'admin.institute.program.search']);
        $router->delete('program/{ids}', ['uses' => 'ProgramController@destroy', 'as' => 'admin.institute.program.destroy']);
        $router->resource('program', 'ProgramController', ['except' => [ 'destroy', 'show']]);

        $router->get('academic-year/datatables', ['uses' => 'AcademicYearController@datatables', 'as' => 'admin.institute.academic-year.datatables']);
        $router->get('academic-year/search', ['uses' => 'AcademicYearController@search', 'as' => 'admin.institute.academic-year.search']);
        $router->delete('academic-year/{ids}', ['uses' => 'AcademicYearController@destroy', 'as' => 'admin.institute.academic-year.destroy']);
        $router->resource('academic-year', 'AcademicYearController', ['except' => [ 'destroy', 'show'], 'parameters' => ['academic-year' => 'academicYear']]);
});