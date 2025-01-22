<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

	    $validator = Validator::make($request->all(), [
		    'name' => 'required|string',
		    'email' => 'required|email',
		    'password' => 'required|min:8',
		    'confirm_password' => 'required|min:8|same:password'
	    ]);

	    if ($validator->fails()){
		    return response()->json([
			    'status' => 422,
			    'message' => 'Validation errors',
			    'data' => $validator->errors(),
		    ], 422);

	    }

		$authService = new AuthService();
		$response = $authService->register($request);
	    // Proceed with registration logic
	    return response()->json([
		    'message' => $response['message'],
		    'data' => $response['data']
	    ], $response['status']);

    }

	public function login(Request $request) {

		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json([
				'status' => 422,
				'message' => 'Validation errors',
				'data' => $validator->errors(),
			], 422);
		}

		$authService = new AuthService();
		$response = $authService->login($request);
		// Proceed with registration logic
		return response()->json([
			'message' => $response['message'],
			'data' => $response['data']
		], $response['status']);

	}
}
