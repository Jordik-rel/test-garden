<?php

namespace App\Http\Requests\Jardinier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class JardinierCompetenceRequest extends FormRequest
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
            'jardinier_id'=>['required',Rule::exists('jardiniers','id')],
            'competences'=>['required','array'],
            'competences.*'=>[Rule::exists('competences','id')]
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'jardinier_id' => Auth::user()->jardinier->id,
        ]);
    }
}
