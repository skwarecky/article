<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository{

	public const LIMIT = 10;

	public function paginated(){
		return User::query()->paginate(self::LIMIT);
	}

}
