<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService {
	public function register($request) {

		$isDuplicateUser = User::where('email', $request['email'])->count();
		if (!$isDuplicateUser) {
			$user = User::create([
				'name'     => $request['name'],
				'email'    => $request['email'],
				'password' => Hash::make($request['password']),
			]);

			return array(
				'status'  => 201,
				'message' => "User created successfully",
				'data'    => [
					'name' => $user->name,
					'email' => $user->email,
					'created at' => $user->created_at,
				]
			);

		} else {

			return array(
				'status'  => 422,
				'message' => "A user with this email " . $request['email'] . " already exist, try again with different email or login to continue",
				'data'    => null
			);
		}

	}

	public function login($request) {

		$user = User::where('email', $request['email'])->first();

		if ($user) {

			if (Hash::check($request['password'], $user->password)) {

				$token = $user->createToken('auth_token')->plainTextToken;

				return [
					'status'  => 200,
					'message' => "Login successful",
					'data'    => [
						'token' => $token
					]
				];


			} else {
				return [
					'status'  => 401,
					'message' => "Invalid credentials. Please check your email and password.",
					'data'    => null
				];
			}
		}
		else{
			return [
				'status'  => 400,
				'message' => "User not found. Please register first.",
				'data'    => null
			];
		}
	}

}