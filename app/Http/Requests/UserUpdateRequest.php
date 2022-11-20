<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Rules\ValidateAuthorEditor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{

    public function rules()
    {

        return [
			'email' =>[ 'required', 'string', 'email', 'max:255',
				Rule::unique('users')->where(function ($query) {
					return $query->where('email', '!=', $this->email);
				})
			],
			'name' => 'required|string',
			'is_author' => [
				new ValidateAuthorEditor('is_editor', 'Editor')
			],
			'is_editor' => [
				new ValidateAuthorEditor('is_author', 'Author')
			],
        ];
    }
}
