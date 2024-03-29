<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function rentalServers()
    {
        return $this->hasMany('App\Models\Plan');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
