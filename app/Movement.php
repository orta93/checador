<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = "capturas";

    public $timestamps = false;

    protected $fillable = [
        'user',
        'checkin',
        'checkout',
        'inip',
        'outip',
    ];
}
