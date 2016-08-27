<?php

namespace App\Master;

use Roseffendi\Dales\DTDataProvider;
use Roseffendi\Dales\Laravel\ProvideDTData;
use Illuminate\Database\Eloquent\Model;

class SubDistrict extends Model implements DTDataProvider
{
    use ProvideDTData;

    /**
     * Available columns to serve in datatables
     * 
     * @var array
     */
    protected $dtColumns = ['id', 'name', 'district_id', 'created_at', 'deleted_at'];

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
     * Define district relation
     * 
     * @return relation
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
}