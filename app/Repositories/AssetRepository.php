<?php

namespace App\Repositories;

use App\Models\Asset;

class AssetRepository{

	public const LIMIT = 10;

	public function paginated(){
		return Asset::query()->paginate(self::LIMIT);
	}

}
