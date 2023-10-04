<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'proveedor_id' => 'required',
            'tipo_comprobante' => 'required|max:20',
            'numero_comprobante' => 'required|max:20',
            'producto_id' => 'required',
            'cantidad' => 'required',
            'precio_compra' => 'required',
        ];
    }
}
