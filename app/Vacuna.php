<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacuna extends Model
{
    protected $table="vacunas";
    Protected $fillable=[
        'id',
        'idMascota',
        "vaNombre",
        "vaFecha",
        "vaNota",
    ];

    public function mascotas()
    {
        return $this->belongsToMany('App\Mascota','idMascota');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'idUsuario');
    }

}
