<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class GeneradorPdfController extends Controller
{
    public function pdf()
    {        

        $pdf = PDF::loadView('hola');
        //return $pdf->stream();
        return $pdf->download('listado.pdf');
    }
}
