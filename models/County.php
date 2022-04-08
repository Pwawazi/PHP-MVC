<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'county_name',
        'county_code'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}