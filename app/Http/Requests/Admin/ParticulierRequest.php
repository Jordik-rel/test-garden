<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ParticulierRequest extends FormRequest
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
            'nom'=>['required','string','max:255'],
            'prenom'=>['required','string','max:255'],
            'username'=>['required','string','max:50','unique:users,username'],
            'email'=>['required','email','unique:users,email'],
            'phone'=>['required','string','size:10'],
            'password'=>['required','string',Password::default()],
            'role'=>['required','string'],
            'profile_photo_path'=>['nullable','file','mimes:png,jpg,pdf','max:2048']
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'password'=> Str::random(12),
            'role'=> 'user',
            'username'=>  strtolower($this->nom[0]) . strtolower($this->prenom[0]) . Str::random(5)
        ]);
    }
}
