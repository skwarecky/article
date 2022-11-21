<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

	public const LIMIT = 10;

	public function paginated(){
		return User::query()->orderBy('created_at', 'DESC')->paginate(self::LIMIT);
	}

}
