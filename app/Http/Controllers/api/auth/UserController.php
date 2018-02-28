<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ],[
            'username.required'=>"No ingresó su nombre de usuario",
            'password.required'=>"No ingresó la contraseña",
        ]);

        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors()], 401);            
        }

        if(Auth::attempt(['username' => $request->username, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
           
            return response()->json([
                'data' => $success,
                'mensaje'=>"Bienvenido ".Auth::user()->username], $this->successStatus);
        }
        else{
            $user=User::where("username","LIKE",$request->username);

            if($user){
                return response()->json(['errors'=>['password'=>['Contraseña incorrecta']]], 422);
            }else{
                return response()->json(['errors'=>['password'=>['Usuario no registrado']]], 422);   
            }
            
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'bail|required|unique:users,username,max:30',
            'correo' => 'bail|required|email|unique:users,correo|max:180',
            'password' => 'bail|required|max:20',
            'nombre'=>"required|max:180",
            "direccion"=>"required",
            "telefono"=>"nullable|max:20",
            "celular"=>"required|max:20",
        ],[
            'username.required'=>"No ingresó su nombre de usuario",
            'username.unique'=>"El nombre de usuario ya existe",
            'username.max'=>"El nombre de usuario no debe excederse de los 30 caracteres",
            'correo.unique'=>"El correo ya esta registrado",
            'correo.required'=>"No ingresó el correo",
            'correo.email'=>"El correo no tiene un formato valido",
            'correo.max'=>"El correo no debe excederse de los 180 caracteres",
            'password.required'=>"No ingresó la contraseña",
            'password.max'=>"El password no debe excederde los 20 caracteres",
            'nombre.required'=>"No ingresó su nombre completo",
            'nombre.max'=>"Su nombre no debe excederse de los 180 caracteres",
            "direccion.required"=>"No ingresó su dirección",
            "telefono.max"=>"El número de teléfono no debe excederse de los 20 caracteres",
            "celular.max"=>"El número celular no debe excederse de los 20 caracteres",
            "celular.required"=>"No ingresó su número celular",
        ]);


        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors()], 401);            
        }


        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['username'] =  $user->username;


        return response()->json(['success'=>$success], $this->successStatus);
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

}
