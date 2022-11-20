<?php

namespace App\Repositories;

use App\Models\Article;

class ArticleRepository{

	public const LIMIT = 10;

	public function paginated(){
		return Article::query()->paginate(self::LIMIT);
	}

}
