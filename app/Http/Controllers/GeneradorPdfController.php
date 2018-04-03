<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\RegistroMedico;
use App\Historial;
use PDF;

class GeneradorPdfController extends Controller
{
    public function pdf($idMascota)
    {        

        $mascota = Mascota::find($idMascota);
        $historial = $mascota->historial;
        $registros = $historial->registrosmedicos;
        
        $pdf = PDF::loadView('historial',['mascota'=>$mascota,'registros'=>$registros]);
        return $pdf->download('listado.pdf');
    }

     public function    visualizar($idMascota)
    {        

        $mascota = Mascota::find($idMascota);
        $historial = $mascota->historial;
        $registros = $historial->registrosmedicos;

        $pdf = PDF::loadView('historial',['mascota'=>$mascota,'registros'=>$registros]);
        return $pdf->stream();
        //return $pdf->download('listado.pdf');
    }

}
