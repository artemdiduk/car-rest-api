<?php

namespace App\Repository;

use App\interfaceRepository\CarsRepositoryInterface;
use App\Model\CarsModel;
use Framework\Helper;
use Illuminate\Database\Eloquent\Model;

class CarsRepository implements CarsRepositoryInterface
{
    private $car;

    public function __construct(Model $model)
    {
        $this->car = $model;
    }

    public function getName($brand, $name)
    {
        return $this->car->where("name", Helper::requestReplace("-", " ", $name))
            ->whereHas('brand', function ($query) use ($brand) {
                $query->where('name', $brand);
            })
            ->get();
    }

    public function getSlug($brand, $name, $slug)
    {
        $data = $this->getName($brand, $name)->where("slug", $slug)->first();
        return $data;
    }

    public function deleteSlug($brand, $name, $slug)
    {
        if ($this->getSlug($brand, $name, $slug)) {
            return $this->getSlug($brand, $name, $slug)->delete();
        }
        return false;

    }
    public function deleteName($brand, $name)
    {
        if ($this->getName($brand, $name)) {
            $data = $this->getName($brand, $name);
            $data->map(
                fn($c) =>
                $c->delete()
            );
            return true;
        }
        return false;
    }

    public function getCarId($id)
    {
        return $this->car->find($id);
    }

    public function updateName($name, $id)
    {
        $car = $this->getCarId($id);
        $car->name = $name;
        $car->save();
        return $car;
    }
    public function updateColor($color, $id)
    {
        $car = $this->getCarId($id);
        $car->color = $color;
        $car->save();
        return $car;
    }

    public function updateSlug($slug, $id)
    {
        $car = $this->getCarId($id);
        $car->slug = $slug;
        $car->save();
        return $car;
    }

    public function updatePrice($price, $id)
    {
        $car = $this->getCarId($id);
        $car->price = $price;
        $car->save();
        return $car;
    }
    public function updateBrandId($brandId, $id)
    {
        $car = $this->getCarId($id);
        $car->brand_id = $brandId;
        $car->save();
        return $car;
    }


    public function updateNameAll($brand, $name, $newName)
    {
        $cars = $this->getName($brand, $name);
        $cars->map(
            function ($car) use ($newName) {
                $car->name = $newName;
                $car->save();
            }
        );
        return $cars;
    }

    public function create($carData) {
        $data =  $this->car->create([
            "name" => $carData->name,
            'brand_id' => $carData->brand_id,
            'slug' => $carData->slug,
            'price' => $carData->price,
            'color' => $carData->color
        ]);
        return $data;

    }
}