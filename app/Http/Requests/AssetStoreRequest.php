<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetStoreRequest extends FormRequest
{
	public function rules()
	{
		return [
			'title' => 'required|string',
			'file' => [ 'required', 'mimes:jpeg,png,doc,docs,pdf,xls,csv,txt', 'max:2000']
		];
	}
}
