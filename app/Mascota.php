<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table="mascotas";
    Protected $fillable=[
        'id',
        'idUsuario',
        'masNombre',
        'masRaza',
        'masTipo',
        'masSexo',
        'masEdad',
        'masSenaPart',
        'masFoto',
        'masHobbie',
        "masCompPerf",
        "masActivo",

    ];

   
   public function usuario()
   {
       return $this->belongsTo('App\User', 'idUsuario');
   }

   public function historial()
   {
       return $this->hasOne('App\Historial', 'idMascota');
   }

   public function veterinarios()
   {
       return $this->belongsToMany('App\Veterinario', 'mascota_veterinario','idMascota','idVeterinario');
   } 
   
   public function vacunas()
   {
       return $this->belongsToMany('App\Vacuna','vacuna_mascota', 'idVacuna', 'idMascota');
   }
   
}
