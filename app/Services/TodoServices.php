<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TodoServices {

	public function create($request) {

		try {

			$userId = Auth::user()->id;

			$todo = Todo::create([
				'user_id'     => $userId,
				'title'       => $request['title'],
				'description' => $request['description'],
				'dateline'    => $request['dateline'],
				'completed'   => intval($request['completed']),
			]);
		}
		catch (\Exception $exception) {
			\Log::error($exception->getMessage());
			return [
				'status'  => 500,
				'message' => "An error occurred while adding a new todo, please try again",
				'data'    => null
			];
		}

		return array(
			'status'  => 201,
			'message' => "Task added successfully",
			'data'    => [
				'title'       => $todo->title,
				'description' => $todo->description,
				'dateline'    => $todo->dateline,
				'completed'   => boolval($todo->completed),
			]
		);

	}

	public function getTodos() {
		$userId = Auth::user()->id;
		$todos = Todo::where('user_id', $userId)->get();

		if ($todos->count() > 0) {
			return array(
				'status'  => 200,
				'message' => "List of all todos",
				'data'    => $todos
			);

		} else {
			return [
				'status'  => 404,
				'message' => "The  user does not have any todo item",
				'data'    => null
			];
		}

	}

	public function getTodoById($id) {
		try {
			// Attempt to find the Todo item
			$todo = Todo::find($id);

			if (!$todo) {
				return array(
					'status'  => 404,
					'message' => "Todo item not found",
					'data'    => null,
				);
			}

			return array(
				'status'  => 200,
				'message' => "Todo item retrieved successfully",
				'data'    => [
					'id'          => $todo->id,
					'user_id'     => $todo->user_id,
					'title'       => $todo->title,
					'description' => $todo->description,
					'dateline'    => $todo->dateline,
					'completed'   => boolval($todo->completed),
					'created_at'  => $todo->created_at,
					'updated_at'  => $todo->updated_at
				]
			);
		}
		catch (\Exception $exception) {
			\Log::error($exception->getMessage());

			return array(
				'status'  => 500,
				'message' => "An error occurred while retrieving the todo item, please try again",
				'data'    => null,
			);
		}
	}

	public function updateTodo(Request $request, $id) {

		try {
			$todo = Todo::find($id);

			if (!$todo) {
				return array(
					'status'  => 404,
					'message' => "Todo item not found",
					'data'    => null,
				);
			}

			$todo->update($request);

			return array(
				'status'  => 200,
				'message' => "Todo item updated successfully",
				'data'    => [
					'id'          => $todo->id,
					'user_id'     => $todo->user_id,
					'title'       => $todo->title,
					'description' => $todo->description,
					'dateline'    => $todo->dateline,
					'completed'   => boolval($todo->completed),
					'created_at'  => $todo->created_at,
					'updated_at'  => $todo->updated_at
				]
			);
		}
		catch (\Exception $exception) {
			\Log::error($exception->getMessage());

			return array(
				'status'  => 500,
				'message' => "An error occurred while updating the todo item, please try again",
			);
		}
	}

	public function destroyTodo($id) {

		try {
			$todo = Todo::find($id);

			if (!$todo) {
				return array(
					'status'  => 404,
					'message' => "Todo item not found",
					'data'    => null,
				);
			}

			$response = $todo->delete();

			return array(
				'status'  => 200,
				'message' => "Todo item deleted successfully",
				'data'    => [
					'id'          => $response->id,
				]
			);
		}
		catch (\Exception $exception) {
			\Log::error($exception->getMessage());

			return array(
				'status'  => 500,
				'message' => "An error occurred while deleting the todo item, please try again",
			);
		}
	}


}