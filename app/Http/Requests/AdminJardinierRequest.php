<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            // 'note_moyenne'=>['required','integer'],
            // 'nombre_missions'=>['required','integer'],
            'site_web'=>['nullable','string','url'],
            'user_id'=>['required','exists:users,id'],
        ];
    }
}
