<?php

namespace App\Http\Controllers;

use App\ServiceApp;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class LoginPageController extends Controller
{	
	public function showLoginPage()
	{
		if ($state = request()->get('state')) {
			// Redirect from VkAuth
			$requestData = [
				'code'      => request()->get('code'),
				'state'     => $state,
				'type'      => request()->get('type'),
				'device_id' => request()->get('device_id'),
			];	
			
			// Already existed info	
			$sessionData = [
				'code_verifier' => session()->get('code_verifier'),
				'client_id'     => ServiceApp::ID,
			];	

			$dataToAccess = array_merge($sessionData, $requestData);

			$this->getAccessToken($dataToAccess);	

		}
		
		return view('log');
	}

	public function getAccessToken($data)
	{
		$response = Http::post('https://id.vk.com/oauth2/auth', [
			'grant_type'    => 'authorization_code',		
			'code'          => $data['code'],		
			'code_verifier' => $data['code_verifier'],		
			'client_id'     => $data['client_id'],		
			'device_id'     => $data['device_id'],		
			'redirect_uri'  => 'http://localhost',		
			'state'         => app('App\Http\Controllers\AuthController')
			                    ->getRandomWord(31),		
		]);
		
		echo $response;
	}

}
