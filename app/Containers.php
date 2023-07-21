<?php
namespace App;
use App\Controller\DeleteController;
use App\Controller\MainController;
use App\Model\BrandModel;
use App\Model\CarsModel;
use App\Repository\BrandRepository;
use App\Repository\CarsRepository;
use Framework\Api\Api;
use App\Controller\UpdateController;
use App\Controller\CreateController;
class Containers {

    public $containers;

    public function __construct() {
        $this->containers['MainController'] = new MainController(
            new Api(),
            new BrandRepository(
                new BrandModel()
            ),
            new CarsRepository(
                new CarsModel()
            ),    
        );
        $this->containers['DeleteController'] = new DeleteController(
            new Api(),
            new BrandRepository(
                new BrandModel()
            ),
            new CarsRepository(
                new CarsModel()
            ),    
        );
        $this->containers['UpdateController'] = new UpdateController(
            new Api(),
            new BrandRepository(
                new BrandModel()
            ),
            new CarsRepository(
                new CarsModel()
            ),    
        );
        $this->containers['CreateController'] = new CreateController(
            new Api(),
            new BrandRepository(
                new BrandModel()
            ),
            new CarsRepository(
                new CarsModel()
            ),    
        );
    }

}