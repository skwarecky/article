<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleStoreRequest extends FormRequest
{

	public function rules()
	{
		return [
			'title' => 'required|string|max:255',
			'content' => 'nullable|string',
			'article_asset.*.asset' => 'required_unless:article_asset,array'
		];
	}
}
