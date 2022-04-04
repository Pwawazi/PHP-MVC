<?php


require __DIR__.'/../base/Database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('role_user', function ($table) {
        $table->integer('user_id');
        $table->integer('role_id');
    });