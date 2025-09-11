<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RobaStoreRequest extends FormRequest
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
            'naziv' => ['required', 'max:255', 'string'],
            'sifra' => ['required', 'max:255', 'string'],
            'opis' => ['required', 'max:255', 'string'],
            'kolicina' => ['required', 'numeric'],
            'lokacija' => ['required', 'max:255', 'string'],
        ];
    }
}
