<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name.required'   => 'El titulo es requerido',
            'name.string'     => 'Debe ingresar solo caracteres',
            'name.max'        => 'El titulo requiere maximo 100 caracteres',

            'email.required'   => 'La descripción es requerida',
            'email.string'     => 'Debe ingresar solo caracteres',
            'email.email'      => 'El formato del correo no es valido',
            'email.unique'     => 'El correo ya existe',
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
            'name'          => 'required|string|max:100',
            'email'         => 'required|string|email|unique:users,email,'.request()->get("id").',id',,
        ];
    }
}
