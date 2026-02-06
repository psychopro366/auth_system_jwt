<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rule;
use App\Rules\ValidName;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', new ValidName()],
            'email' => 'required|email|unique:users|max:20',
            'password' => ['required', 'confirmed', 
            Password::min(5)->max(10)
            ],
            'gender' => 'required',
            'hobbies' => 'required',
            'profile' => ['required', 
           File::image()->max(2*1024)
            ]
        ];
    }
}
