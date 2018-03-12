<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mascota;
use App\Historial;
use App\User;
use Validator;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idUsuario)
    {
        $mascotas=User::find($idUsuario)->mascotas;

            return response()->json([
                'mascotas' => $mascotas 
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
        $nombrefoto=null;

        $validator = Validator::make($request->all(), [
            'masNombre'=>'bail|required|max:100',
            'masRaza'=>'bail|required|max:100',
            'masTipo'=>'required',
            'masSexo'=>'required',
            'masEdad'=>'bail|required|numeric|between:0,100',
            'masSenaPart'=>'required',
            'masFoto'=>'nullable',
            'masHobbie'=>'nullable',
        ],[
            'masNombre.required'=>'No ingresó el nombre su mascota',
            'masNombre.max'=>'El nombre de su mascota no debe exceder de los 100 caracteres',
            'masRaza.required'=>'No ingresó la raza de su mascota',
            'masRaza.max'=>'La raza de su mascota no debe exceder de los 100 caracteres',
            'masTipo.required'=>'No ingresó el tipo de mascota',
            'masSexo.required'=>'No ingresó el sexo de su mascota',
            'masEdad.required'=>'No ingresó la edad de su mascota',
            'masEdad.numeric'=>'El dato edad no es un valor numérico',
            'masEdad.between'=>'La edad de su mascota esta fuera del rango (0-100)',
            'masSenaPart.required'=>'No ingresó las señas particulares de su mascota',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        try{

            $mascota=new Mascota($request->all());

            if($request->file('masFotoFile'))
            {
                $file=$request->file('masFotoFile');
                $nombrefoto='mascota_' . time() . '.'.$file->getClientOriginalExtension();
                $path = public_path().'/mascotas';
                $file->move($path,$nombrefoto);
                $mascota->masFoto=$nombrefoto;
            }else{
                $mascota->masFoto="sinfoto.jpg";
            }
            
           
            $mascota->save();

            $historial = new Historial();
            $historial->idMascota=$mascota->id;
            $historial->save();

        }catch(\Exception $e){
            return response()->json(['errors' => $e->getMessage()], 401);
        }
        

        return response()->json([
            'success' =>"La mascota $mascota->masNombre se guardo con éxito" 
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($idMascota)
    {
        $mascota=Mascota::find($idMascota);
        return response()->json([
            'mascota' =>$mascota 
        ], 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idMascota)
    {
        $mascota=Mascota::find($idMascota);
        return response()->json([
            'mascota' =>$mascota 
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idMascota)
    {
        $nombrefoto=null;

        $validator = Validator::make($request->all(), [
            'masNombre'=>'bail|required|max:100',
            'masRaza'=>'bail|required|max:100',
            'masTipo'=>'required',
            'masSexo'=>'required',
            'masEdad'=>'bail|required|numeric|between:0,100',
            'masSenaPart'=>'required',
            'masFoto'=>'nullable',
            'masHobbie'=>'nullable',
        ],[
            'masNombre.required'=>'No ingresó el nombre su mascota',
            'masNombre.max'=>'El nombre de su mascota no debe exceder de los 100 caracteres',
            'masRaza.required'=>'No ingresó la raza de su mascota',
            'masRaza.max'=>'La raza de su mascota no debe exceder de los 100 caracteres',
            'masTipo.required'=>'No ingresó el tipo de mascota',
            'masSexo.required'=>'No ingresó el sexo de su mascota',
            'masEdad.required'=>'No ingresó la edad de su mascota',
            'masEdad.numeric'=>'El dato edad no es un valor numérico',
            'masEdad.between'=>'La edad de su mascota esta fuera del rango (0-100)',
            'masSenaPart.required'=>'No ingresó las señas particulares de su mascota',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        if($request->file('masFotoFile'))
        {
            $file=$request->file('masFotoFile');
            $nombrefoto='mascota_' . time() . '.'.$file->getClientOriginalExtension();
            $path = public_path().'/mascotas';
            $file->move($path,$nombrefoto);
        }

        try{
            $mascota=Mascota::find($idMascota);
            $mascota->fill($request->all());
            $mascota->save();

        }catch(\Exception $e){
            return response()->json(['errors' => $e], 200);
        }
        

        return response()->json([
            'success' =>"La mascota $mascota->masNombre se actualizó con éxito" 
        ], 201);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idMascota)
    {
        $mascota=Mascota::find($idMascota);
        unlink(public_path('mascotas/'.$mascota->masFoto));
        $mascota->delete();

        return response()->json([
            'success' =>"La mascota $mascota->masNombre se eliminó con éxito" 
        ], 201);
    }


    public function compartirPerfil($idMascota)
    {
        $mascota=Mascota::find($idMascota);

        if($mascota->masCompPerf==0)
            $mascota->masCompPerf=1;
        else
            $mascota->masCompPerf=0;
        
        $mascota->save();

        return response()->json([
            'success' =>"El perfil de $mascota->masNombre se compartió con éxito" 
        ], 201);
    }

}
