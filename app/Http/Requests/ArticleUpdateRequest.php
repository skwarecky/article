<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
{

	public function rules()
	{
		return [
			'title' => 'required|string',
			'content' => 'nullable|string|max:255',
			'article_asset.*.asset' => 'required_unless:article_asset,array'
		];
	}
}
