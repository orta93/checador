<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departamento';

    public $timestamps = false;

    protected $fillable = [
        'id', 'nombre'
    ];
}
