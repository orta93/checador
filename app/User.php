<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'nombre', 'clave', 'dpto', 'tipo', 'email', 'password', 'key', 'img', 'type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'clave', 'password'
    ];

    public function getDepartmentAttribute()
    {
        return Department::find($this->dpto)->nombre;
    }
}
