<?php

namespace App\Http\Requests\Request;

use Illuminate\Foundation\Http\FormRequest;

class HouseRequest extends FormRequest
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
            'title' => 'required|min:3|max:100',
            'rooms' => 'required|min:1|max:125',
            'bathrooms' => 'required|min:1|max:125',
            'bed' => 'required|min:1|max:125',
            'address' => 'required|min:1|max:100',
        ];
    }

    public function messages()
    {

        return [

            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve contenere almeno :min caratteri',
            'title.max' => 'Il titolo deve contenere massimo :max caratteri',

            'rooms.required' => 'Il numero di stanze è obbligatorio',
            'rooms.min' => 'Il numero di camere minimo è :min',
            'rooms.max' => 'Il numero di camere massimo è :max',

            'bathrooms.required' => 'Il numero di bagni è obbligatorio',
            'bathrooms.min' => 'Il numero di bagni minimo è :min',
            'bathrooms.max' => 'Il numero di bagni massimo è :max',

            'bed.required' => 'Il numero di letti è obbligatorio',
            'bed.min' => 'Il numero di letti minimo è :min',
            'bed.max' => 'Il numero di letti massimo è :max',

            'address.required' => 'L\'indirizzo è obbligatorio',
            'address.min' => 'L\'indirizzo non può essere più corto di :min carattere',
            'address.max' => 'L\'indirizzo non può essere più lungo di :max caratteri',
        ];
    }
}
