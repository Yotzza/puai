<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IzvestajStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'zaposleni_id' => ['required', 'exists:zaposlenis,zaposleni_id'],
            'opis' => ['required', 'max:255', 'string'],
            'datum' => ['required', 'date'],
            'tip' => ['required', 'max:255', 'string'],
        ];
    }
}
