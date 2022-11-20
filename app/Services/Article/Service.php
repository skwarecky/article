<?php

namespace App\Services\Article;

use App\Models\Article;

class Service
{

	public function create(\Illuminate\Http\Request $request)
	{
		$article = Article::create([
			'user_id' => data_get(auth()->user(), 'id'),
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);

		$this->syncAssets($article, data_get($request, 'article_asset', []));

		return $article;
	}

	public function update(Article $article, \Illuminate\Http\Request $request)
	{
		$this->syncAssets($article, data_get($request, 'article_asset', []));

		return $article->update([
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);


	}

	private function syncAssets(Article $article, array $articleAssets)
	{
		$this->removeArticleAssets($article);

		foreach($articleAssets as $articleAsset){
			$article->articleAsset()->create([
				'asset_id' => data_get($articleAsset, 'asset.id'),
			]);
		}
	}

	private function removeArticleAssets(Article $article)
	{
		$article->articleAsset()->delete();
	}
}
