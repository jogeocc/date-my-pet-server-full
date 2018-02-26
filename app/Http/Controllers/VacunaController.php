<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Vacuna;

class VacunaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function visualizarVacunas($idUsuario)
    {
        $vacunas=Vacuna::where('idUsuario',$idUsuario)->get();
        
        return response()->json([
            'data' => $vacunas 
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
            return response()->json(['data'=>$validator->errors()], 200);            
        }

        try{
            $vacuna = new Vacuna($request->all());
            $vacuna->save();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "La vacuna $vacuna->vaNombre se guardo con éxito" 
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
            'data' => $vacuna 
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
            return response()->json(['data'=>$validator->errors()], 200);            
        }

        try{
            $vacuna =Vacuna::find($id);
            $vacuna->fill($request->all());
            $vacuna->save();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "La vacuna $vacuna->vaNombre se editó con éxito" 
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
            $vacuna->delete();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "La vacuna $vacuna->vaNombre se eliminó con éxito" 
        ], 201);
    }
}
