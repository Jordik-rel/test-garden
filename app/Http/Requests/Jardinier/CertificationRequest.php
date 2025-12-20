<?php

namespace App\Http\Requests\Jardinier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CertificationRequest extends FormRequest
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
            'nom'=>['required','string'],
            'description'=>['nullable','string'],
            'date_obtention'=>['nullable','date'],
            'date_expiration'=>['nullable','date'],
            'image'=>['nullable','image'],
            'jardinier_id'=>['required','exists:jardiniers,id'],
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'jardinier_id'=> Auth::user()->jardinier->id
        ]);
    }
}
