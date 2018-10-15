<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class PictureFormRequest extends FormRequest
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
            'picture' => 'image|mimes:jpeg,jpg,png'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'picture.image' => 'É obriatório que o arquivo enviado seja uma imagem.',
            'picture.mimes' => 'A foto deve ter uma das seguintes extensões: jpeg, jpg ou png.'
        ];
    }
}
