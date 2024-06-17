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
            'rooms' => 'required|min:1',
            'bathrooms' => 'required|min:1',
            'bed' => 'required|min:1',
            'latitude' => 'required|numeric|min:-90|max:90',
            'longitude' => 'required|numeric|min:-180|max:180'
        ];
    }

    public function messages(){

        return[

            'title.required' => 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve contenere almeno :min caratteri',
            'title.max' => 'Il titolo deve contenere massimo :max caratteri',

            'rooms.required' => 'Il numero di stanze è obbligatorio',
            'rooms.min' => 'Il numero di camere minimo è :min',

            'bathrooms.required' => 'Il numero di bagni è obbligatorio',
            'bathrooms.min' => 'Il numero di bagni minimo è :min',

            'bed.required' => 'Il numero di letti è obbligatorio',
            'bed.min' => 'Il numero di letti minimo è :min',


            'latitude.required' => 'La latitudine è obbligatoria',
            'latitude.numeric' => 'La latitudine deve essere un valore numerico',
            'latitude.min' =>'La latitudine non può essere inferiore a :min °' ,
            'latitude.max' => 'La latitudine non può essere maggiore di :max °',


            'longitude.required' => 'La longitudine è obbligatoria ',
            'longitude.numeric' => 'La longitudine deve essere un valore numerico',
            'longitude.min' => 'La longitudine non può essere inferiore a :min °',
            'longitude.max' => 'La longitudine non può essere maggiore di :max °',


        ];

    }
}
