<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubMenuUpdateRequest extends FormRequest
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
            'titulo.required'   => 'El titulo es requerido',
            'titulo.string'     => 'Debe ingresar solo caracteres',
            'titulo.max'        => 'El titulo requiere maximo 100 caracteres',
            'titulo.unique'     => 'El titulo ya existe',

            'descripcion.required'   => 'La descripción es requerida',
            'descripcion.string'     => 'Debe ingresar solo caracteres',
            'descripcion.max'        => 'El titulo requiere maximo 255 caracteres',

            'url.required'      => 'La url es requerida',
            'url.string'        => 'Debe ingresar solo caracteres',
            'url.unique'        => 'La url ya existe',

            'icono.required'    => 'El icono es requerido',
            'icono.string'      => 'Debe ingresar solo caracteres',
            'icono.max'         => 'El icono debe contener maximo 100 caracteres',
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
            'titulo'        => 'required|string|max:100|unique:sub_menu,title,'.request()->get("id_submenu"),
            'descripcion'   => 'required|string|max:255',
            'url'           => 'required|string|unique:sub_menu,url,'.request()->get("id_submenu"),
            'icono'         => 'required|string|max:100'
        ];
    }
}
