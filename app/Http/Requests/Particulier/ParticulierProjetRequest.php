<?php

namespace App\Http\Requests\Particulier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ParticulierProjetRequest extends FormRequest
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
            'titre'=>['required','string','max:255',],
            'taille_poste'=>['required','integer','min:1','max:5',],
            'duree'=>['required','integer',],
            'niveau_experience'=>['required',],
            'type_emploi'=>['required','integer','min:0','max:2',],
            'tarif_type'=>['required','integer','min:0','max:1',],
            'tarif_min'=>['required_if:tarif_type,0','integer',],
            'tarif_max'=>['required_if:tarif_type,0','integer','gte:tarif_min',],
            'budget'=>['required_if:tarif_type,1','integer',],
            'description'=>['required','string','min:50','max:5000'],
            'support'=>['nullable','file','mimes:pdf,doc,docx,txt','max:3072',],
            'competences'=>['required','array',],
            'competences.*'=>['integer','exists:competences,id'],
            'status'=>['required','integer','min:1','max:6',],
            'is_Post'=>['required','integer','min:0','max:1',],
            'user_id'=>['required',],
        ];
    }

    public function messages()
    {
        return [
            'titre.required'=>'Le titre du projet est obligatoire.',
            'titre.string'=>'Le titre du projet doit être une chaîne de caractères.',
            'titre.max'=>'Le titre du projet ne doit pas dépasser 255 caractères.',
            'description.required'=>'La description du projet est obligatoire.',
            'description.string'=>'La description du projet doit être une chaîne de caractères.',
            'description.min'=>'La description du projet doit contenir au moins 50 caractères.',
            'description.max'=>'La description du projet ne doit pas dépasser 5000 caractères.',
            'support.file'=>'Le support doit être un fichier valide.',
            'support.mimes'=>'Le support doit être un fichier de type : pdf, doc, docx, txt.',
            'support.max'=>'Le support ne doit pas dépasser 3 Mo.',
            // Add more custom messages as needed
        ];
    }

    public function prepareForValidation()
    {
        return $this->merge([
            'user_id'=>Auth::id(),
            'is_Post'=> true ,
            'status'=>1
        ]);
    }
}
