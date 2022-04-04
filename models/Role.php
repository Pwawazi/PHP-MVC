<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}