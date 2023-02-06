<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePerfilRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(){
        return [
            'name.required'         => 'nombre requerida',
            'name.string'           => 'El nombre debe contener solo caracteres',
            'name.max'              => 'El nombre debe contener maximo 50 caracteres',
            'style.required'        => 'El estilo es requerido',
            'style.int'             => 'El estilo no existe',
        ];
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'          => 'required|string|max:50',
            'style'         => 'required|int|min:1',
        ];
    }
}
