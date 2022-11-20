<?php

namespace App\Services\Article;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;

class Service
{

	/**
	 * Create new article
	 * @param ArticleStoreRequest $request
	 * @return mixed
	 */
	public function create(ArticleStoreRequest $request): mixed
	{
		$article = Article::create([
			'user_id' => data_get(auth()->user(), 'id'),
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);

		$this->syncAssets($article, data_get($request, 'article_asset', []));

		return $article;
	}

	/**
	 * Update article
	 * @param Article $article
	 * @param ArticleUpdateRequest $request
	 * @return bool
	 */
	public function update(Article $article, ArticleUpdateRequest $request): bool
	{
		$this->syncAssets($article, data_get($request, 'article_asset', []));

		return $article->update([
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);
	}

	/**
	 * Synchronize asset with specyfic article
	 * @param Article $article
	 * @param array $articleAssets
	 */
	private function syncAssets(Article $article, array $articleAssets): void
	{
		$this->removeArticleAssets($article);

		foreach($articleAssets as $articleAsset){
			$article->articleAsset()->create([
				'asset_id' => data_get($articleAsset, 'asset.id'),
			]);
		}
	}

	/**
	 * Remove all asigned assets
	 * @param Article $article
	 */
	private function removeArticleAssets(Article $article): void
	{
		$article->articleAsset()->delete();
	}
}
