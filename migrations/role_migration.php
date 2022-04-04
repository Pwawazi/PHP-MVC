<?php


require __DIR__.'/../base/Database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('roles', function ($table) {
        $table->increments('id');
        $table->string('role');
    });