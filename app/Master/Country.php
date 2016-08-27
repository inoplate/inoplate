<?php

namespace App\Master;

use Roseffendi\Dales\DTDataProvider;
use Roseffendi\Dales\Laravel\ProvideDTData;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements DTDataProvider
{
    use ProvideDTData;

    /**
     * Available columns to serve in datatables
     * 
     * @var array
     */
    protected $dtColumns = ['id', 'name', 'created_at', 'deleted_at'];

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

    public function provinces()
    {
        $this->hasMany(Provinces::class);
    }
}