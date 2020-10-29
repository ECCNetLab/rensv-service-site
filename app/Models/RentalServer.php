<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain',
        'user_id',
        'plan_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function plan()
    {
        return $this->belongsTo('App\Models\Plan');
    }

    public function ftpUser()
    {
        return $this->hasOne('App\Models\FtpUser');
    }
}
