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

		$todoService = new TodoServices();
		$response = $todoService->getTodos();
		return response()->json([
			'message' => $response['message'],
			'data'    => $response['data']
		], $response['status']);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function createTodo() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function storeTodo(Request $request) {

		$validator = Validator::make($request->all(), [
			'title'       => 'required|string',
			'description' => 'string',
			'dateline'    => 'required|date|after:yesterday',
			'completed'   => 'required|boolean',
		]);

		if ($validator->fails()) {
			return response()->json([
				'status'  => 422,
				'message' => 'Validation errors',
				'data'    => $validator->errors(),
			], 422);
		}

		$todoService = new TodoServices();
		$response = $todoService->create($request);
		return response()->json([
			'message' => $response['message'],
			'data'    => $response['data']
		], $response['status']);
	}

	/**
	 * Display the specified resource.
	 */
	public function showTodo($id) {

		if (!$id) {

			return response()->json([
				'status'  => 422,
				'message' => 'The todo id must be provided',
			], 422);
		}

		$todoService = new TodoServices();
		$response = $todoService->getTodoById($id);
		return response()->json([
			'message' => $response['message'],
			'data'    => $response['data']
		], $response['status']);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function editTodo(Todo $todo) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function updateTodo(Request $request, $id) {

		$validator = Validator::make($request->all(), [
			'title'       => 'required|string',
			'description' => 'nullable|string',
			'dateline'    => 'nullable|date',
			'completed'   => 'nullable|boolean',
		]);

		if ($validator->fails()) {
			return response()->json([
				'status'  => 422,
				'message' => 'Validation errors',
				'data'    => $validator->errors(),
			], 422);
		}
		$todoService = new TodoServices();
		$response = $todoService->updateTodo($request, $id);
		return response()->json([
			'message' => $response['message'],
			'data'    => $response['data']
		], $response['status']);

	}


	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy($id) {

		if (!$id) {
			return response()->json([
				'status'  => 422,
				'message' => 'The todo id must be provided',
			], 422);
		}

		$todoService = new TodoServices();
		$response = $todoService->destroyTodo($id);
		return response()->json([
			'message' => $response['message'],
			'data'    => $response['data']
		], $response['status']);
	}
}
