<?php

namespace App\Student;

use Roseffendi\Dales\DTDataProvider;
use Roseffendi\Dales\Laravel\ProvideDTData;
use Illuminate\Database\Eloquent\Model;

class Student extends Model implements DTDataProvider
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
        'entry_year', 
        'program_id',
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
     * Define program relation
     * 
     * @return Relation
     */
    public function program()
    {
        return $this->belongsTo(\App\Institute\Program::class);
    }

    /**
     * Retrieve aggregate entry years
     * 
     * @return array
     */
    public function entryYear()
    {
        return static::select('entry_year')->groupBy('entry_year')->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfProgram($query, $programId)
    {
        if($programId) {
            return $query->where('program_id', $programId);
        }

        return $query;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfEntryYear($query, $entryYear)
    {
        if($entryYear) {
            return $query->where('entry_year', $entryYear);
        }

        return $query;
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