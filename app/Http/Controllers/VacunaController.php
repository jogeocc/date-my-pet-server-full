<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vacuna;
use App\Mascota;
use Validator;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visualizarVacunas($idMascota)
    {
        $vacunas=Vacuna::where('idMascota',$idMascota)->get();
        
        return response()->json([
            'vacunas' => $vacunas 
        ], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'idMascota'=>"required",
            "vaNombre"=>"bail|required|max:100",
            "vaFecha"=>'bail|required|date',
            "vaNota"=>"nullable",
        ],[
            'idMascota.required'=>"No seleccionó su mascota",
            "vaNombre.required"=>"No ingresó el nombre de la vacuna ",
            "vaNombre.max"=>"El nombre de la vacuna no debe exceder de 100 caracteres",
            "vaFecha.required"=>'No ingresó la fecha de aplicación',
            "vaFecha.date"=>'La fecha no cuenta con un formato válido',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        try{
            $vacuna = new Vacuna($request->all());
            $vacuna->save();

            $mascota=Mascota::find($vacuna->idMascota);

        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()], 401);
        }

        return response()->json([
            'success' => "La vacuna $vacuna->vaNombre para $mascota->masNombre se guardo con éxito" 
        ], 201);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idVacuna)
    {
        $vacuna=Vacuna::find($idVacuna);
        
        return response()->json([
            'vacuna' => $vacuna 
        ], 201);
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
        $validator = Validator::make($request->all(), [
            'idMascota'=>"required",
            "vaNombre"=>"bail|required|max:100",
            "vaFecha"=>'bail|required|date',
            "vaNota"=>"nullable",
        ],[
            'idMascota.required'=>"No seleccionó su mascota",
            "vaNombre.required"=>"No ingresó el nombre de la vacuna ",
            "vaNombre.max"=>"El nombre de la vacuna no debe exceder de 100 caracteres",
            "vaFecha.required"=>'No ingresó la fecha de aplicación',
            "vaFecha.date"=>'La fecha no cuenta con un formato válido',
        ]);

        if ($validator->fails()) {
            return response()->json(['data'=>$validator->errors()], 401);            
        }

        try{
            $vacuna =Vacuna::find($id);
            $vacuna->fill($request->all());
            $vacuna->save();

            $mascota=$vacuna->mascota;

        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 401);
        }

        return response()->json([
            'success' => "La vacuna $vacuna->vaNombre de $mascota->masNombre se editó con éxito" 
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $vacuna =Vacuna::find($id);
            $mascota = $vacuna->mascota;    
            dd($mascota);
            $vacuna->delete();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 401);
        }

        return response()->json([
            'success' => "La vacuna $vacuna->vaNombre de $mascota->masNombre se eliminó con éxito" 
        ], 201);
    }
}
