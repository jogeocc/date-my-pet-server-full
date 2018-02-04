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

    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'idMascota');
    }

}
