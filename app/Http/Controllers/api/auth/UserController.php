<?php

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Validator;

class UserController extends Controller
{
    use IssueTokenTrait;

    public $successStatus = 200;

    private $client;

	public function __construct(){
		$this->client = Client::find(1);
	}

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

            if($user->activo==1){
                $success['access_token'] =  $user->createToken('DateMyPet')->accessToken;
                $success['username'] =  $user->username;
                $success['email'] =  $user->correo;
                $success['name'] =  $user->nombre;
                $success['id'] =  $user->id;
                $success['activo'] =  $user->activo;
    
                return response()->json(['success'=>$success], $this->successStatus);
            }else{

                return response()->json(["errors"=>["Activo"=>"Su cuenta esta desactivada"]], 403);   
            }
           
          
        }
        else{
            $user=User::where("username","LIKE",$request->username)->get();
           
            if($user->count()==0){
                return response()->json(['errors'=>['password'=>['Usuario no registrado']]], 421);
            }else{
               
                return response()->json(['errors'=>['password'=>['Contraseña incorrecta']]], 420); 
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
        $success['access_token'] =  $user->createToken('DateMyPet')->accessToken;
        $success['username'] =  $user->username;
        $success['email'] =  $user->correo;
        $success['name'] =  $user->nombre;
        $success['id'] =  $user->id;
        $success['atributo_nuevo'] =  "Hola";


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

    public function edit($idUsuario)
    {
        $user = User::find($idUsuario);
        return response()->json(['usuario' => $user], $this->successStatus);
    }

    public function show($idUsuario)
    {
        $user = User::find($idUsuario);
        return response()->json(['usuario' => $user], $this->successStatus);
    }

    public function destroy($idUsuario)
    {
        $user = User::find($idUsuario);
        $user->mascotas()->delete();
        $user->veterinarios()->delete();
        $user->delete();
        
        return response()->json(['success' => "$user->username dio de baja su cuenta con éxito"], $this->successStatus);
    }

    public function update(Request $request, $idUsuario)
    {
        $user = User::find($idUsuario);

        $validator = Validator::make($request->all(), [
            'username' => 'bail|required|max:30|unique:users,username,'.$user->id,
            'correo' => 'bail|required|email|max:180|unique:users,correo,'.$user->id,
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

        
        $user->fill($request->all());
        $user->save();
        return response()->json(['success' => "$user->username, su cuenta se actualizó con éxito"], $this->successStatus);
    }

}
