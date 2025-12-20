<?php

namespace App\Http\Requests\Jardinier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Propositionrequest extends FormRequest
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
            'tarif_propose' => 'required|integer|min:0',
            'duree' => 'required|integer|in:1,2,3,4',
            'message' => 'required|string|max:5000',
            'support'=> 'nullable|array|max:3',
            'support.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,png|max:4096',
            'projet_id' => 'required|exists:projets,id',
            'user_id'=>'required|exists:users,id'
        ];
    }

    public function messages(): array
    {
        return [
            'tarif_propose.required' => 'Le tarif proposé est obligatoire.',
            'tarif_propose.integer' => 'Le tarif proposé doit être un nombre entier.',
            'tarif_propose.min' => 'Le tarif proposé doit être au moins de 0.',

            'duree.required' => 'La durée est obligatoire.',
            'duree.integer' => 'La durée doit être un nombre entier.',
            'duree.in' => 'La durée sélectionnée est invalide.',

            'message.required' => 'Le message est obligatoire.',
            'message.string' => 'Le message doit être une chaîne de caractères.',
            'message.max' => 'Le message ne doit pas dépasser 5000 caractères.',

            'support.file' => 'Le support doit être un fichier valide.',
            'support.mimes' => 'Le support doit être un fichier de type : pdf, doc, docx, jpg, png.',

            'is_Accepted.required' => "L'état d'acceptation est obligatoire.",
            'is_Accepted.boolean' => "L'état d'acceptation doit être vrai ou faux.",

            'projet_id.required' => 'L\'ID du projet est obligatoire.',
            'projet_id.exists' => 'Le projet sélectionné n\'existe pas.',
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'projet_id' =>  $this->route('projet'),
            'user_id'=>Auth::id()
        ]);
    }
}
