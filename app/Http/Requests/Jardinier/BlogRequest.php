<?php

namespace App\Http\Requests\Jardinier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BlogRequest extends FormRequest
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
            'title'=>['required','string'],
            'subtitle'=>['required','string'],
            'image'=>['nullable','file','mimes:jpg,png,pdf','max:2048'],
            'description'=>['required','string'],
            'jardinier_id'=>['required','exists:jardiniers,id'],
            'status'=>['nullable','integer','in:1,2,3']
        ];
    }

    protected function prepareForValidation()
    {
        return $this->merge([
            'jardinier_id'=>Auth::user()->jardinier->id
        ]);
    }
}
