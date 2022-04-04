<?php


require __DIR__.'/../base/Database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('products', function ($table) {
        $table->increments('id');
        $table->string('product_name');
        $table->unsignedInteger('user_id');
        $table->decimal('price', $precision = 8, $scale = 2);
        $table->text('description')->nullable();
        $table->string('product_image_name');
        $table->unsignedInteger('stock');
        $table->boolean('on_sale')->default(false);
        $table->timestamps();
    });