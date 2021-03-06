<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Mascota;
use App\Cita;
use Carbon\Carbon;
use Validator;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // dd("hokaaaaaa");
       $fechaDeHoy=Carbon::now()->format("Y-m-d");
        $auxMascotas=User::find($request->idUsuario)->mascotas->pluck('id');
        $citas=Cita::with('mascota')
                    ->whereIn('idMascota',$auxMascotas)
                    ->whereBetween("ciFecha",[$fechaDeHoy,Carbon::parse($fechaDeHoy)->addMonth()->format("Y-m-d")])
                    ->orderBy("ciFecha","ASC")
                    ->get();
       
        return response()->json([
            'citas' => $citas 
        ], 201);
    }


    public function listaMisCitas(Request $request)
    {
       // dd("hokaaaaaa");
     
        $auxMascotas=User::find($request->idUsuario)->mascotas->pluck('id');
        $citas=Cita::with('mascota')
                    ->whereIn('idMascota',$auxMascotas)
                    ->orderBy("ciFecha","ASC")
                    ->get();
       
        return response()->json([
            'citas' => $citas 
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
        $validator = Validator::make($request->all(), [
            'idMascota'=>'required',
            'idVeterinario'=>'required',
            "ciFecha"=>'bail|required|after_or_equal:'.Carbon::now()->format('Y-m-d'),
            'ciTipo'=>'required',
            'ciHora'=>'required',
        ],[
          'idMascota.required'=>"No seleccionó a una mascota",
          'idVeterinario.required'=>"No seleccionó a un veterinario",
          "ciFecha.required"=>"No ingresó la fecha de la cita",
          "ciFecha.after_or_equal"=>"La fecha de la cita solo puede ser mayor o igual a la fecha actual",
          'ciTipo.required'=>'No ingresó el tipo de cita',
           'ciHora.required'=>'No ingresó la hora de la cita',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        try{
            $cita=new Cita($request->all());
            $cita->save();

            $mascota=$cita->mascota;
            

        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()], 401); 
        }

        return response()->json([
            'success' => "La cita para el ".Carbon::parse($cita->ciFecha)->format('d-m-Y')." de $mascota->masNombre se registró con exito"
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
        $cita=Cita::with('mascota','veterinario')->find($id);

        return response()->json([
            'cita' => $cita
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
        $cita=Cita::find($id);

        return response()->json([
            'cita' => $cita
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
            'idMascota'=>'required',
            'idVeterinario'=>'required',
            "ciFecha"=>'bail|required|after_or_equal:'.Carbon::now()->format('Y-m-d'),
            'ciTipo'=>'required',
            'ciHora'=>'required',
        ],[
          'idMascota.required'=>"No seleccionó a una mascota",
          'idVeterinario.required'=>"No seleccionó a un veterinario",
          "ciFecha.required"=>"No ingresó la fecha de la cita",
          "ciFecha.after_or_equal"=>"La fecha de la cita solo puede ser mayor o igual a la fecha actual",
          'ciTipo.required'=>'No ingresó el tipo de cita',
          'ciHora.required'=>'No ingresó la hora de la cita',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 401);            
        }

        try{

            $cita=Cita::find($id);
            $cita->fill($request->all());
            $cita->save();

        }catch(\Exception $e){
            return response()->json(['errors'=>$e->getMessage()], 403); 
        }


        return response()->json([
            'success' => "La cita para el ".Carbon::parse($cita->ciFecha)->format('d-m-Y')." se actualizó con exito"
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
        $cita=Cita::find($id);
        $cita->delete();

        return response()->json([
            'success' => "La cita para el ".Carbon::parse($cita->ciFecha)->format('d-m-Y')." se eliminó con exito"
        ], 201);

    }
}
