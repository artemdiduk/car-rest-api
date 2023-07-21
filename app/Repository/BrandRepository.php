<?php

namespace App\Repository;
use App\interfaceRepository\BrandRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
class BrandRepository implements BrandRepositoryInterface
{
    private $brand;
    public function __construct(Model $model)
    {
        $this->brand = $model;
    }
    public function getBrands()
    {
        return $this->brand->get();
    }
    public function getBrand($brand)
    {
        return $this->brand->where('name', $brand)->first();
    }
    public function getBrandId($id)
    {
        return $this->brand->find($id);
    }
    public function getBrandAndInfo($brand)
    {
        $brand = $this->getBrand($brand);
        return $brand->info()->get();
    }
    public function getBrandAndInfoFirst($brand)
    {
        return $this->getBrandAndInfo($brand)->first();
    }

    public function delete($name) {
       return $this->getBrand($name)->delete();
    }

    public function updateName($name, $id) {
        $brand = $this->getBrandId($id);
        $brand->name = $name;
        $brand->save();
        return $brand;
    }

    public function createBrand($name) {
       if(is_null($this->getBrand($name))){
            $this->brand->name = $name;
            $this->brand->save();
            return $this->brand;
       }
    }
}