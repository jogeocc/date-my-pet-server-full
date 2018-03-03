<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cita extends Model
{
    protected $table="citas";
    Protected $fillable=[
       'id',
       'idMascota',
       'idVeterinario',
       "ciFecha",
        'ciTipo',
        "ciNota",
    ];

    public function mascota()
    {
        return $this->belongsTo('App\Mascota', 'idMascota');
    }

    public function veterinario()
    {
        return $this->belongsTo('App\Veterinario', 'idVeterinario');
    }

    public function getFechaParseada()
    {
        return Carbon::parse($this->ciFecha)->format("d/m/Y");
    }

}
