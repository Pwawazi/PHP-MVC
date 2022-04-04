<?php


require __DIR__.'/../base/Database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('users', function ($table) {
        $table->increments('id');
        $table->string('firstname');
        $table->string('lastname');
        $table->string('email')->unique();
        $table->string('phone_number')->unique();
        $table->unsignedInteger('role_id');
        $table->unsignedInteger('county_id');
        $table->string('password');
        $table->string('userimage')->nullable();
        $table->string('api_key')->nullable()->unique();
        $table->rememberToken();
        $table->timestamps();
    });