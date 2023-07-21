<?php
require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(require 'database.php');

$capsule->setAsGlobal();

$capsule->bootEloquent();
require __DIR__ . '/app/router.php';
