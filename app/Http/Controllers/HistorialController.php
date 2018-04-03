<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Historial;
use App\Mascota;
use App\RegistroMedico;
use Carbon\Carbon;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idMascota)
    {
        $mascota = Mascota::find($idMascota);
        $historial = $mascota->historial;

        if($historial==null){
           $historial = new Historial();
           $historial->idMascota=$mascota->id;
           $historial->save();        
        }

        $registros=$historial->with('veterinario')->registrosmedicos;

        return response()->json([
            'registros' =>$registros 
        ], 201);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mascota=Mascota::find($request->idMascota);
        $historial=$mascota->historial;

        $validator = Validator::make($request->all(), [
            'idVeterinario'=>'required',
            'regMedFecha'=>'bail|required|before_or_equal:'.Carbon::now()->format('Y-m-d'),
            'regMedPercanse'=>'required|max:80',
            'regMedDescp'=>'required'
        ],[
            'regMedFecha.required'=>'No ingresó la fecha de registro médico',
            'regMedFecha.before_or_equal'=>'La fecha del registro médico debe ser menor o igual a la fecha actual',
            
            'regMedPercanse.required'=>'No ingresó el percance',
            'idVeterinario.required'=>'No ingresó el veterinario',
            'regMedPercanse.max'=>'El percance no debe exceder de los 80 caracteres',
            'regMedDescp.required'=>'No ingresó la descripción del percance'
        ]);

        if ($validator->fails()) {
            return response()->json(['data'=>$validator->errors()], 401);            
        }

        try{
            $registro=new RegistroMedico($request->all());
            $registro->idHistorial=$historial->id;
            $registro->save();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 402); 
        }

        return response()->json(['success'=>"registro médico registrado exitosamente"], 201); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idRegistro)
    {
        $registro = RegistroMedico::find($idRegistro);
        return response()->json(['registros'=>$registro], 201); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
