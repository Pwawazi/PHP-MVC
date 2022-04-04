<?php


require __DIR__.'/../base/Database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('counties', function ($table) {
        $table->increments('id');
        $table->string('county_name');
        $table->integer('county_code');
    });