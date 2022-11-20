<?php

namespace App\Services\Article;

use App\Models\Article;

class Service
{

	public function create(\Illuminate\Http\Request $request)
	{
		return Article::create([
			'user_id' => data_get(auth()->user(), 'id'),
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);
	}

	public function update(Article $article, \Illuminate\Http\Request $request)
	{
		return $article->update([
			'title' => data_get($request, 'title'),
			'content' => data_get($request, 'content'),
		]);


	}
}
