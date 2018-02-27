<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;
use Validator;

class LoginController extends Controller
{

    use IssueTokenTrait;

	private $client;

	public function __construct(){
		$this->client = Client::find(1);
	}

    public function login(Request $request){

        $validator = Validator::make($request->all(), [
            'username' => 'bail|required',
            'password' => 'bail|required',
        ],[
            'username.required'=>"No ingresó su nombre de usuario",
            'password.required'=>"No ingresó la contraseña",
        ]);

        if ($validator->fails()) {
            return response()->json(["errors"=>$validator->errors()], 401);            
        }

        return $this->issueToken($request, 'password');

    }

    public function refresh(Request $request){
    	$this->validate($request, [
    		'refresh_token' => 'required'
    	]);

    	return $this->issueToken($request, 'refresh_token');

    }

    public function logout(Request $request){

    	$accessToken = Auth::user()->token();

    	DB::table('oauth_refresh_tokens')
    		->where('access_token_id', $accessToken->id)
    		->update(['revoked' => true]);

    	$accessToken->revoke();

    	return response()->json([], 204);

    }
}
