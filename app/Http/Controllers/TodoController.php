<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Services\AuthService;
use App\Services\TodoServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller {
	/**
	 * Display a listing of the resource.
	 */
	public function index() {
		return "OK";
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request) {

		$validator = Validator::make($request->all(), [
			'title' => 'required|string',
			'description' => 'string',
			'dateline' => 'required|date|after:yesterday',
			'completed' => 'required',
		]);


		if (!$validator->fails()){

			$todoService = new TodoServices();
			$response = $todoService->create($request);
			return response()->json([
				'message' => $response['message'],
				'data' => $response['data']
			], $response['status']);

		}
		else{
			return response()->json([
				'status' => 422,
				'message' => 'Validation errors',
				'data' => $validator->errors(),
			], 422);
		}
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Todo $todo) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Todo $todo) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Todo $todo) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Todo $todo) {
		//
	}
}
