<?php

namespace Reserva\Http\Requests;

use Reserva\Http\Requests\Request;

class ComponenteRequest extends Request
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
            'nombre_complemento' => 'max:120|required|unique:complementos'
        ];
    }
}
