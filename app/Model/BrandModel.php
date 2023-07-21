<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use App\Model\CarsModel;
class BrandModel extends Model
{
    public $timestamps = false;
    
    protected $table = 'brands';

    public function info()
    {
        return $this->hasMany(CarsModel::class, 'brand_id', 'id');
    }    
}