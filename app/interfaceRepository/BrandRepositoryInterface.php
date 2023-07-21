<?php
namespace App\interfaceRepository;
interface BrandRepositoryInterface {
    public function getBrands();

    public function getBrand($brand);

    public function getBrandAndInfo($brand);

    public function getBrandAndInfoFirst($brand);

    public function delete($name);

    public function updateName($name, $id);

    public function createBrand($name);
}
