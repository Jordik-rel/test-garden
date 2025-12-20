<?php

namespace App\Http\Requests\Jardinier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EducationRequest extends FormRequest
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
            'nomEcole'=>['required','string'],
            'nomFormation'=>['required','string'],
            'ville'=>['required','string'],
            'pays'=>['required','string'],
            'dateDebut'=>['required','date'],
            'dateFin'=>['nullable','date'],
            'niveauetude'=>['required','string'],
            'domaine'=>['required','string'],
            'description'=>['required','string'],
            'jardinier_id'=>['required','exists:jardiniers,id']
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'jardinier_id'=>Auth::user()->jardinier->id
        ]);
    }
}
