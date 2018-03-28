<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'username',
        'nombre',
        'correo',
        "direccion",
        "telefono",
        "celular",
        'password',
        'activo',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function mascotas()
    {
        return $this->hasMany('App\Mascota', 'idUsuario');
    }

    public function veterinarios()
    {
        return $this->hasMany('App\Veterinario', 'idUsuario');
    }

}
