<?php

namespace App\Services\User;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Auth\Events\Registered;

class Service
{

	/**
	 * @param UserStoreRequest $request
	 */
	public function create(UserStoreRequest $request)
	{
		$user = User::create([
			'is_author' => data_get($request, 'is_author'),
			'is_editor' => data_get($request, 'is_editor'),
			'name' => data_get($request, 'name'),
			'email' => data_get($request, 'email'),
			'password' => Hash::make(data_get($request, 'password')),
		]);

		event(new Registered($user));

		return $user;
	}

	/**
	 * @param User $user
	 * @param UserUpdateRequest $request
	 */
	public function update(User $user, UserUpdateRequest $request)
	{
		return $user->update([
			'is_author' => data_get($request, 'is_author'),
			'is_editor' => data_get($request, 'is_editor'),
			'name' => data_get($request, 'name'),
			'email' => data_get($request, 'email')
		]);
	}
}
