<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarginacionesRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function messages(){
        return [
            'titulo.required'   => 'El titulo es requerido',
            'libro.required' => 'required|max:3',
            'partida.required' => 'required',
            'folio.required'=>'required',
            'annio.required'=>'required|max:4|min:4',
            'tipo.required' => 'required',
            'texto.required'=>'required',
            'libromarg.required' => 'required',
            'marginacion.required' => 'required',
            'habilitado.required' => 'required',
            'textoh.required' => 'required',
            'iniciales.required' => 'required',
            'jefe.required' => 'required',
            'user.required' => 'required',
        ];
    }
}
