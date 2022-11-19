<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|alpha',
            'avatar' => 'file|mimes:jpg,jpeg,png',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => 'What is your name?',
            "name.alpha" => 'Please write only alphabetic characters',
            "avatar.file" => 'Choose a file',
            "avatar.mimes" => "File must be only in jpg,jpeg or png format",
            "email.required" => "What is your email?",
            "email.email" => "Invalid email",
            "email.unique" => "Profile exists",
            "password.required" => "Please write strong password",
            "password.confirmed" => "The password confirmation doesn't match",
            "password.min" => "The minimum number of characters for the password is 8"
        ];
    }
}

