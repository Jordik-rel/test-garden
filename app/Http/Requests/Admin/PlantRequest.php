<?php

namespace App\Http\Requests\Admin;

use App\Models\PlantCategorie;
use App\Models\ValeurNutritionnelle;
use App\Models\VertuMedicinale;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlantRequest extends FormRequest
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
            'nom_scientifique'=>['required','string','max:255'],
            'nom_local'=>['required','string','max:255'],
            'image'=>['required','array'],
            'image.*'=>['required','file','mimes:jpg,jpeg,png,webp','max:4096'],
            'description'=>['required','string'],
            'precautions'=>['required','string'],
            'conseil_culture'=>['required','string'],
            'valeur_nutritionnelles'=>['required','array'],
            'valeur_nutritionnelles*'=>[Rule::exists(ValeurNutritionnelle::class,'id')],
            'vertus'=>['required','array'],
            'vertus*'=>[Rule::exists(VertuMedicinale::class,'id')],
            'categories'=>['required','array'],
            'categories*'=>[Rule::exists(PlantCategorie::class,'id')]
        ];
    }
}
