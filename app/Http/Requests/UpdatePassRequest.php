<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassRequest extends FormRequest
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
            'present_password.required'         => 'Contraseña actual es requerida',
            'password.required'                 => 'La contraseña es requerida',
            'password.min'                      => 'La contraseña debe contener minimo 8 caracteres',
            'password.confirmed'                => 'Las contraseñas no coinciden',
            'password_confirmation.required'    => 'La confirmación es requerida',
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
            'present_password'      => 'required',
            'password'              => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
