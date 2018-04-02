<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class GeneradorPdfController extends Controller
{
    public function pdf()
    {        

        $pdf = PDF::loadView('welcome');

       // return $pdf->download('listado.pdf');
    }
}
