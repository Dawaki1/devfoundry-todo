<?php

namespace App\Services;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class TodoServices {

	public function create($request) {

		$userId = Auth::user()->id;

		$todo = Todo::create([
			'user_id'     => $userId,
			'title'       => $request['title'],
			'description' => $request['description'],
			'dateline'    => $request['dateline'],
			'completed'   => $request['completed'],
		]);

		return array(
			'status'  => 201,
			'message' => "Task added successfully",
			'data'    => $todo
		);

	}

}