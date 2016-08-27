<?php

namespace App\Providers;

use Inoplate\Account\Services\Permission\Collector as PermissionCollector;
use Inoplate\Foundation\Providers\AuthServiceProvider as ServiceProvider;

class InoplateAuthServiceProvider extends ServiceProvider
{
    /**
     * @inherit_docs
     */
    protected $moduleName = 'Aplikasi';
    
    /**
     * Register permisions
     * 
     * @return array
     */
    protected function registeredPermissions()
    {
        return array_merge(
            require __DIR__.'/../../database/collections/institute.php',
            require __DIR__.'/../../database/collections/master.php',
            require __DIR__.'/../../database/collections/student.php',
            require __DIR__.'/../../database/collections/employee.php',
            require __DIR__.'/../../database/collections/academic.php'
        );
    }
}