<?php

namespace App\Controller;

use App\interfaceRepository\BrandRepositoryInterface;
use App\interfaceRepository\CarsRepositoryInterface;
use Framework\Api\ApiInterface;
use Framework\Controller\Сontroller;


class CreateController extends Сontroller
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
    
    public function createBrand() {
        if($data = $this->brandRepository->createBrand($this->api->getRequestReceptionJson()->name)) {
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($data));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(["error" => 404]));
    }

    public function createCar($brandId) {
        if($this->brandRepository->getBrandId($brandId) and $this->brandRepository->getBrandId($this->api->getRequestReceptionJson()->brand_id)) {
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet(
                $this->carRepository->create($this->api->getRequestReceptionJson())
            ));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(["error" => 404]));
    }

}