<?php

namespace App\Academic;

use Roseffendi\Dales\DTDataProvider;
use Roseffendi\Dales\Laravel\ProvideDTData;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model implements DTDataProvider
{
    use ProvideDTData;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'classes';

    /**
     * Available columns to serve in datatables
     * 
     * @var array
     */
    protected $dtColumns = ['id', 'code', 'name', 'subject_id', 'academic_year_id', 'lecturer_id', 'created_at', 'deleted_at'];

    /**
     * Unsearchable columns
     * 
     * @var array
     */
    protected $dtUnsearchable = ['id', 'created_at', 'deleted_at'];

    /**
     * Unsortable columns
     * 
     * @var array
     */
    protected $dtUnsortable = ['id'];

    /**
     * Create new Country instance
     * 
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->dtModel = $this;
    }

    /**
     * Define subject relationship
     * 
     * @return relation
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Define lecturer relationship
     * 
     * @return relation
     */
    public function lecturer()
    {
        return $this->belongsTo(\App\Employee\Lecturer::class);
    }

    /**
     * Define academic year relation
     * 
     * @return relation
     */
    public function academicYear()
    {
        return $this->belongsTo(\App\Institute\AcademicYear::class, 'academic_year_id');
    }

    /**
     * Define academic students relation
     * 
     * @return relation
     */
    public function students()
    {
        return $this->belongsToMany(\App\Student\Student::class, 'class_student', 'class_id', 'student_id');
    }
}