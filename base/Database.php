<?php

namespace app\base;

require_once __DIR__.'/../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
   "driver" => "mysql",
   "host" =>"localhost",
   "database" => "mo",
   "username" => "philip",
   "password" => "WAWAZIphilip123!"
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();