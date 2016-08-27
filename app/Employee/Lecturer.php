<?php

namespace App\Employee;

use Roseffendi\Dales\DTDataProvider;
use Roseffendi\Dales\Laravel\ProvideDTData;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model implements DTDataProvider
{
    use ProvideDTData;

    /**
     * Available columns to serve in datatables
     * 
     * @var array
     */
    protected $dtColumns = [
        'id', 
        'name', 
        'reg_no', 
        'local_reg_no', 
        'status', 
        'gender',
        'created_at', 
        'deleted_at'
    ];

    /**
     * Unsearchable columns
     * 
     * @var array
     */
    protected $dtUnsearchable = ['id', 'created_at', 'deleted_at', 'program_id'];

    /**
     * Unsortable columns
     * 
     * @var array
     */
    protected $dtUnsortable = ['id'];

    protected $fillable = ['reg_no'];

    /**
     * Define country relation
     * 
     * @return Relation
     */
    public function country()
    {
        return $this->belongsTo(\App\Master\Country::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfStatus($query, $status)
    {
        if($status) {
            return $query->where('status', $status);
        }

        return $query;
    }
}