<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PayementRequest extends FormRequest
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
            'reseau'=>['required','string'],
            'numéro'=>['required','string','size:10','unique:payements,numéro'],
            'status'=>['nullable','boolean'],
            'user_id'=>['required','exists:users,id'],
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'user_id'=>Auth::id()
        ]);
    }
}
