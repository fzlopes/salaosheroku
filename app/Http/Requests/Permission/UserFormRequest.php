<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserFormRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $email_rule = 'required|email|unique:users,email,' . $this->get('id');
        } else {
            $email_rule = 'required|email|unique:users,email';
        }

        return [
            'name'  => 'required|min:3',
            'email' => $email_rule,
            'role'  => 'required'
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
            'name.min'      => 'o nome é obrigatório e precisa ter no mínimo 3 caracteres.',
            'email.unique'  => 'já existe um usuário com esse e-mail.',
            'email.email'   => 'endereço de e-mail inválido.',
            'role.required' => 'é obrigatório informar a qual grupo este usuário pertence.',
        ];
    }
}
