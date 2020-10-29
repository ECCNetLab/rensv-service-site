<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtpUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'retal_server_id',
        'name',
        'password',
    ];

    public function rentalServer()
    {
        return $this->belongsTo('App\Models\RentalServer');
    }

    public function ftpLogs()
    {
        return $this->hasMany('App\Models\FtpLog');
    }
}
