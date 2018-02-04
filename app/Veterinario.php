<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Veterinario extends Model
{
    protected $table="veterinarios";
    Protected $fillable=[
        'id',
        'vetNombre',
        'vetDireccion',
        'vetTelefono',
        'vetNomVeterinaria',
    ];

    public function historiales()
    {
        return $this->hasMany('App\Historial', 'idVeterinario');
    }

    public function citas()
    {
        return $this->hasMany('App\Citas', 'idVeterinario');
    }

    public function mascotas()
    {
        return $this->belongsToMany('App\Mascota', 'mascota_vetenrinario', 'idVeterinario', 'idMascota');
    }


    
}
