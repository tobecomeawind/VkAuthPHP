<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceApp;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{

	public function createUrlAuthorizeRequest()
	{
		$client_id = ServiceApp::ID;
		$codes     = $this->generateCodes();			

		$response_type  = 'code'                  ;	
		$method         = 's256'                  ;  //code_challenge_method	
		$redirect_uri   = 'http://localhost'      ;
		$state          = $this->getRandomWord(31);
		$scope          = 'email phone'           ;	
		$code_verifier  = $codes['code_verifier' ];
		$code_challenge = $codes['code_challenge'];

		$url = url()->query('https://id.vk.com/authorize', [
			'client_id'             => $client_id,
			'response_type'         => $response_type,
			'scope'	                => $scope,
			'redirect_uri'          => $redirect_uri,
			'state'                 => $state,
			'code_challenge'        => $code_challenge,
			'code_challenge_method' => $method,
		]);	
		
		session([
			'code_verifier' => $code_verifier,
		]);



		return $url;
	}


	public function generateCodes()
	{	
		$code_verifier  = $this->generateCodeVerifier();

		// code_challenge = BASE64URL-ENCODE(SHA256(ASCII(code_verifier)))
		$code_challenge_s256 = hash('sha256', $code_verifier      );	
		$code_challenge      = base64_encode( $code_challenge_s256);	

		return [
			'code_verifier'  => $code_verifier,
			'code_challenge' => $code_challenge
		];	
	}

	public function generateCodeVerifier()
	{		
		/*
		 * RFC 7636(OAuth 2.0) 
		 *
		 * Generating Code Verifier
		 */
		$minLen = 43;	
		$maxLen = 128;	

		// 43 < length < 128
		$randomLength = random_int($minLen, $maxLen); 

		$code = $this->getRandomWord($randomLength);	

		return $code;
	}

	public function getRandomWord ($len)
	{
		$randomWord = array_merge(range('a', 'z'),
                            range('A', 'Z'),
							range('0', '9'),
                            ['-', '.', '_', '~']);
		shuffle($randomWord);

		$word = substr(implode($randomWord), 0, $len);

		return $word;
	}
}
