<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminJardinierRequest extends FormRequest
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
            'profession'=>['required','string'],
            'description'=>['required','string'],
            'tarif_horaire'=>['required','integer'],
            'tarif_journalier'=>['required','integer'],
            'disponible'=>['required','boolean'],
            'site_web'=>['nullable','string','url'],
            'user_id'=>['required','exists:users,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'disponible' => $this->has('disponible')
        ]);
    }
}
