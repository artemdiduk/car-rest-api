<?php

namespace App\Controller;

use App\interfaceRepository\BrandRepositoryInterface;
use App\interfaceRepository\CarsRepositoryInterface;
use Framework\Api\ApiInterface;
use Framework\Controller\Сontroller;


class DeleteController extends Сontroller
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
    public function deleteInName($brand, $name) {
        if($this->carRepository->deleteName($brand, $name)) {
            return $this->renderApi($this->api->getHeaderJson(false, 204)->jsonGet(''));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));
    }

    public  function  deleteInSlug($brand, $name, $slug) {
        if($this->carRepository->deleteSlug($brand, $name, $slug)) {
            return $this->renderApi($this->api->getHeaderJson(false, 204)->jsonGet(''));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));
    }

    public function deleteBrand($brand) {
        if($this->brandRepository->delete($brand)) {
            return $this->renderApi($this->api->getHeaderJson(false, 204)->jsonGet(''));
        } 
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(['error' => 404]));
    }


}