<?php
namespace App\Controller;

use App\interfaceRepository\BrandRepositoryInterface;
use App\interfaceRepository\CarsRepositoryInterface;
use Framework\Api\ApiInterface;
use Framework\Controller\Сontroller;



class MainController extends Сontroller
{

    public $api;
    public $brandRepository;
    public $carRepository;
    public function __construct(ApiInterface $api, BrandRepositoryInterface $brandRepository, CarsRepositoryInterface $carReposityry)
    {
        $this->api = $api;
        $this->brandRepository = $brandRepository;
        $this->carRepository = $carReposityry;
    }

    public function show()
    {
        if ($this->brandRepository->getBrands()) {
            $filteredData = $this->brandRepository->getBrands()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'brand' => $item->name,
                    'info' => $item->info()->get(),
                ];
            });

            return $this->renderApi($this->api->getHeaderJson(false, 200)->jsonGet($filteredData));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));

    }
    public function brand($brand)
    {
        if ($this->brandRepository->getBrand($brand)) {
            $data = [
                'id' => $this->brandRepository->getBrand($brand)->id,
                'brand' => $this->brandRepository->getBrand($brand)->name,
                'info' => $this->brandRepository->getBrandAndInfo($brand),
            ];
           return $this->renderApi($this->api->getHeaderJson(false, 200)->jsonGet($data));
         
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));
    }

    public function name($brand, $name)
    {
        if ($this->carRepository->getName($brand, $name)) {
            $data = [
                'id' => $this->brandRepository->getBrand($brand)->id,
                'brand' => $this->brandRepository->getBrand($brand)->name,
                'info' => $this->carRepository->getName($brand, $name),
            ];
            return  $this->renderApi($this->api->getHeaderJson(false, 200)->jsonGet($data));
            
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));
    }

    public function slug($brand, $name, $slug)
    {
        if ($this->carRepository->getSlug($brand, $name, $slug)) {
            $data = [
                'id' => $this->brandRepository->getBrand($brand)->id,
                'brand' => $this->brandRepository->getBrand($brand)->name,
                'info' => $this->carRepository->getSlug($brand, $name, $slug),
            ];
            return $this->renderApi($this->api->getHeaderJson(false, 200)->jsonGet($data));
            
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));

    }

}