<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterUserRequest extends FormRequest
{

    public function rules()
    {
        return [
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:'.User::class,
			'password' => ['required', 'confirmed', Rules\Password::defaults()],
		];
    }
}
