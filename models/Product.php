<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name', 'user_id', 'price', 'product_image_name', 'stock', 'on_sale', 'description',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}