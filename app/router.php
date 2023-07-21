<?php
use Framework\Route;

use App\Containers;
$containers = new Containers();

Route::set('api/all', ['controller' => $containers->containers['MainController'], "method" => "show"], "GET");
Route::set('api/{brand}', ['controller' => $containers->containers['MainController'], "method" => "brand"], "GET");
Route::set('api/{brand}/{nameCar}', ['controller' => $containers->containers['MainController'], "method" => "name"], "GET");
Route::set('api/{brand}/{nameCar}/{slugCar}', ['controller' => $containers->containers['MainController'], "method" => "slug"], "GET");

Route::set('api/{brand}', ['controller' => $containers->containers['DeleteController'], "method" => "deleteBrand"], "DELETE");
Route::set('api/{brand}/{nameCar}/{slugCar}', ['controller' => $containers->containers['DeleteController'], "method" => "deleteInSlug"], "DELETE");
Route::set('api/{brand}/{nameCar}', ['controller' => $containers->containers['DeleteController'], "method" => "deleteInName"], "DELETE");

Route::set('api/{brand}', ['controller' => $containers->containers['UpdateController'], "method" => "renameBrand"], "PATCH");

Route::set('api/{brand}/{id}/name', ['controller' => $containers->containers['UpdateController'], "method" => "renameCarName"], "PATCH");
Route::set('api/{brand}/{id}/color', ['controller' => $containers->containers['UpdateController'], "method" => "renameCarColor"], "PATCH");
Route::set('api/{brand}/{id}/slug', ['controller' => $containers->containers['UpdateController'], "method" => "renameCarSlug"], "PATCH");
Route::set('api/{brand}/{id}/price', ['controller' => $containers->containers['UpdateController'], "method" => "renameCarPrice"], "PATCH");
Route::set('api/{brand}/{id}/brandId', ['controller' => $containers->containers['UpdateController'], "method" => "renameCarBrandId"], "PATCH");
Route::set('api/{brand}/{name}/name/all', ['controller' => $containers->containers['UpdateController'], "method" => "renameNameCarAll"], "PATCH");

Route::set('api/{brandId}/{id}', ['controller' => $containers->containers['UpdateController'], "method" => "updateCar"], "PUT");

Route::set('api/brand/create', ['controller' => $containers->containers['CreateController'], "method" => "createBrand"], "POST");
Route::set('api/{brand}/create/car', ['controller' => $containers->containers['CreateController'], "method" => "createCar"], "POST");