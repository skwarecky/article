<?php

namespace App\Repositories;

use App\Models\ArticleAsset;
use App\Models\Asset;

class ArticleAssetRepository{

	public const LIMIT = 10;

	public function getById(int $id){
		return ArticleAsset::query()
			->where('article_id', $id)
			->with(['asset'])
			->get();
	}

}
