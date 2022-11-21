<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{

	/**
	 * Check if user is author
	 * @param User $user
	 * @return mixed
	 */
	public function create(User $user)
	{
		return $user->is_author;
	}
}
