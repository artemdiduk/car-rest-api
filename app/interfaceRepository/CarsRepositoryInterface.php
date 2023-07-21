<?php
namespace App\interfaceRepository;
interface CarsRepositoryInterface {
    public function getName($brand, $name);

    public function getSlug($brand, $name, $slug);

    public function deleteSlug($brand, $name, $slug);

    public function deleteName($brand, $name);

    public function getCarId($id);

    public function updateName($name, $id);

    public function updateColor($color, $id);

    public function updateSlug($slug, $id);

    public function updateBrandId($brandId, $id);

    public function updateNameAll($brand, $name, $newName);

    public function create($carData);


}
