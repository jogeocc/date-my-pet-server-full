<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Veterinario;

class VeterinarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUser)
    {
        $veterinarios=User::find($idUser)->veterinarios;

        return response()->json([
            'data' => $veterinarios 
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
            'vetNombre'=>"required|max:180",
            'vetDireccion'=>"nullable",
            'vetTelefono'=>"required|max:20",
            'vetNomVeterinaria'=>"required|max:180",
        ],[
            'vetNombre.required'=>"No ingresó el nombre del veterinario",
            'vetNombre.max'=>"El nombre del veterinario no debe exceder de 180 caracteres",
            'vetNomVeterinaria.required'=>"No ingresó el nombre de la veterinaria",
            'vetNomVeterinaria.max'=>"El nombre de la veterinaria no debe excederse de los 180 caracteres",
            'vetTelefono.required'=>"No ingresó el télefono de la veterinaria",
            'vetTelefono.max'=>"El télefono de la veterinaria no debe exceder de los 20 caracteres",
        ]);

        if ($validator->fails()) {
            return response()->json(['data'=>$validator->errors()], 200);            
        }

        try{
            $veterinario = new Veterinario($request->all());
            $veterinario->save();
            $veterinario->mascotas()->attach($veterinario->idMascota);

        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "El veterinario $veterinario->vetNombre se guardo con éxito" 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $veterinario=Veterinario::find($id);
        return response()->json([
            'data' => $veterinario
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
        $veterinario=Veterinario::find($id);
        return response()->json([
            'data' => $veterinario
        ], 201);
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
            'vetNombre'=>"required|max:180",
            'vetDireccion'=>"nullable",
            'vetTelefono'=>"required|max:20",
            'vetNomVeterinaria'=>"required|max:180",
        ],[
            'vetNombre.required'=>"No ingresó el nombre del veterinario",
            'vetNombre.max'=>"El nombre del veterinario no debe exceder de 180 caracteres",
            'vetNomVeterinaria.required'=>"No ingresó el nombre de la veterinaria",
            'vetNomVeterinaria.max'=>"El nombre de la veterinaria no debe excederse de los 180 caracteres",
            'vetTelefono.required'=>"No ingresó el télefono de la veterinaria",
            'vetTelefono.max'=>"El télefono de la veterinaria no debe exceder de los 20 caracteres",
        ]);


        if ($validator->fails()) {
            return response()->json(['data'=>$validator->errors()], 200);            
        }

        try{
            $veterinario =Veterinario::find($id);
            $veterinario->fill($request->all());
            $veterinario->save();
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "El veterinario $veterinario->vetNombre se editó con éxito" 
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
            $veterinario =Veterinario::find($id);
            $veterinario->delete();
            $veterinario->mascotas()->detach($veterinario->idMascota);
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()], 200);
        }

        return response()->json([
            'data' => "El veterinario $veterinario->vetNombre se eliminó con éxito" 
        ], 201);
    }
}
