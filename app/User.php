<?php

namespace App;

use Roseffendi\Authis\User as Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Authorizable
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Determine if auto increment is disabled
     * 
     * @var boolean
     */
    public $incrementing = false;

    /**
     * Retrieve user unique identifier
     * 
     * @return unique
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * Define roles relationship
     * 
     * @return Model
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_user');
    }

    /**
     * Retrieve user abilities
     * 
     * @return array
     */
    public function abilities()
    {
        $roles = $this->roles;
        $abilities = [];

        foreach ($roles as $role) {
            $permissions = $role->permissions();

            foreach ($permissions as $permission) {
                if( !isset($abilities[$permission->permission_id])) {
                    $abilities[] = $permission->permission_id;
                }
            }
        }

        return $abilities;
    }
}
