<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroMedico extends Model
{
    protected $table="registros_medicos";
    Protected $fillable=[
        'id',
        'idHistorial',
        'idVeterinario',
        'regMedFecha',
        'regMedDescp',
        'regMedPercanse',
    ];

    public function historial()
    {
        return $this->belongsTo('App\Historial', 'idHistorial');
    }

    public function veterinario()
    {
        return $this->belongsTo('App\Veterinario', 'idVeterinario');
    }
   
}
