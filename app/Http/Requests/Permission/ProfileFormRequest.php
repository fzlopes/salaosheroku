<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileFormRequest extends FormRequest
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
            'name'       => 'required|min:3',
            'email'      => 'required|email|unique:users,email,'.Auth::user()->id,
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
            'name.min' => 'o nome é obrigatório e precisa ter no mínimo 3 caracteres.',
            'email.unique' => 'já existe um usuário com esse e-mail.',
            'email.email' => 'endereço de e-mail inválido.',
        ];
    }
}
