<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    protected $table="historiales_medicos";
    Protected $fillable=[
        'id',
        'idMascota'
    ];

    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'idMascota');
    }

    public function registrosmedicos()
    {
        return $this->hasMany('App\RegistroMedico', 'idHistorial');
    }
}
