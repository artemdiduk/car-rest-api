<?php

namespace App\Controller;

use App\interfaceRepository\BrandRepositoryInterface;
use App\interfaceRepository\CarsRepositoryInterface;
use Framework\Api\ApiInterface;
use Framework\Controller\Сontroller;

class UpdateController extends Сontroller
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

    public function updateCar($brandId, $carId)
    {
        if ($this->brandRepository->getBrandId($brandId) && $this->carRepository->getCarId($carId)) {
            $data = $this->api->getRequestReceptionJson();
            $this->carRepository->updateName($data->name ?? "", $carId);
            $this->carRepository->updateBrandId($data->brand_id ?? $brandId, $carId);
            $this->carRepository->updateSlug($data->slug ?? "", $carId);
            $this->carRepository->updatePrice($data->price ?? "", $carId);
            $this->carRepository->updateColor($data->color ?? "", $carId);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($this->carRepository->getCarId($carId)));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }
    public function renameBrand($request)
    {
        if ($this->brandRepository->getBrandId($this->api->getRequestReceptionJson()->id)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->brandRepository->updateName($data->name, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }

    public function renameCarName($request)
    {
        if ($this->carRepository->getCarId($this->api->getRequestReceptionJson()->id)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->carRepository->updateName($data->name, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }

    public function renameCarColor($request, $id)
    {

        if ($this->carRepository->getCarId($this->api->getRequestReceptionJson()->id)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->carRepository->updateColor($data->color, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }

    public function renameCarSlug($request, $id)
    {

        if ($this->carRepository->getCarId($this->api->getRequestReceptionJson()->id)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->carRepository->updateSlug($data->slug, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }

    public function renameCarPrice($request, $id)
    {
        if ($this->carRepository->getCarId($this->api->getRequestReceptionJson()->id)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->carRepository->updatePrice($data->price, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }


    public function renameCarBrandId($request, $id)
    {
        if ($this->brandRepository->getBrandId($this->api->getRequestReceptionJson()->brandId)) {
            $data = $this->api->getRequestReceptionJson();
            $req = $this->carRepository->updateBrandId($data->brandId, $data->id);
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }

    public function renameNameCarAll($brand, $name)
    {
        if ($this->carRepository->getName($this->api->getRequestReceptionJson()->brand, $this->api->getRequestReceptionJson()->name)) {
            $req = $this->carRepository->updateNameAll(
                $this->api->getRequestReceptionJson()->brand,
                $this->api->getRequestReceptionJson()->name,
                $this->api->getRequestReceptionJson()->newName
            );
            return $this->renderApi($this->api->getHeaderJson(true, 200)->jsonGet($req));
        }
        return $this->renderApi($this->api->getHeaderJson(false, 404)->jsonGet(''));
    }
}