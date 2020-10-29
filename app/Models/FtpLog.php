<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FtpLog extends Model
{
    use HasFactory;

    public function ftpUser()
    {
        return $this->belongsTo('App\Models\FtpUser');
    }
}
