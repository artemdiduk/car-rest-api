<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use App\Model\BrandModel;
class CarsModel extends Model
{   
    public $timestamps = false;
    protected $table = 'car_info';

    protected $fillable = ['name', 'brand_id', 'slug', 'price', 'color'];

    public function brand()
    {
        return $this->belongsTo(BrandModel::class, 'brand_id', 'id');
    }
}