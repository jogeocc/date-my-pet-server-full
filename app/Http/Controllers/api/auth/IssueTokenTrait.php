<?php 

namespace App\Http\Controllers\api\auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

trait IssueTokenTrait{

	public function issueToken(Request $request, $grantType, $scope = ""){

		$params = [
    		'grant_type' => $grantType,
    		'client_id' => $this->client->id,
    		'client_secret' => $this->client->secret,    		
    		'scope' => $scope
		];
		
		  if($grantType !== 'social'){
            $params['username'] = $request->username ?: $request->email;
		  }

		$request->request->add($params);
		

    	$proxy = Request::create('oauth/token', 'POST');
		
		//dd($proxy);

    	return Route::dispatch($proxy);

	}

}