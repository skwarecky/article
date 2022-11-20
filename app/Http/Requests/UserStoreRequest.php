<?php

namespace App\Http\Requests;

use App\Rules\ValidateAuthorEditor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
{

    public function rules()
    {
		return [
			'email' =>[ 'required', 'string', 'email', 'max:255', Rule::unique('users')],
			'name' => 'required|string',
			'is_author' => [
				new ValidateAuthorEditor('is_editor', 'Editor')
			],
			'is_editor' => [
				new ValidateAuthorEditor('is_author', 'Author')
			],
			'password' => 'min:6',
			'password_confirmation' => 'required_with:password|same:password|min:6'
		];
    }
}
