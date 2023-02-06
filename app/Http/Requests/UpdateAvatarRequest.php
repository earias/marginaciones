<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
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
            'avatar.mimes'          => 'Formatos requeridos: png, jpg, jpeg',
            'avatar.dimensions'     => 'La dimensión requeridad es de 64x64'
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
            'avatar'    => 'nullable|mimes:png,jpg,jpeg,PNG,JPEG,JPG|dimensions:max_width=64,max_height=64',
        ];
    }
}
