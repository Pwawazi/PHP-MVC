<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone_number', 'role_id', 'county_id', 'password', 'userimage'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function county()
    {
        return $this->belongsToMany(County::class);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }


    public function latestProduct()
    {
        return $this->hasOne(Product::class)->latestOfMany();
    }

    public function oldestOrder()
    {
        return $this->hasOne(product::class)->oldestOfMany();
    }
}