<?php

namespace App\Http\Requests\Schedule;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

     /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date'       => 'required|date',
            'hour'       => 'required',
            'client_id'  => 'required',
            'service_id' => 'required',
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
            'date.required'       => 'a data do agendamento precisa ser informada.',
            'date.date'           => 'a data do agendamento está em um formato incorreto',
            'hour.required'       => 'a hora do agendamento precisa ser informada.',
            'client_id.required'  => 'o nome do cliente precisa ser informado.',
            'service_id.required' => 'o serviço precisa ser informado.',
        ];
    }
}
