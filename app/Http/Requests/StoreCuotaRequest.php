<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuotaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if (is_null($this->remesa_id)) {
            return [
            'cliente_id' => 'required|exists:clientes,id',
            'remesa_id' => 'nullable|exists:remesa,id',
            'importe' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'fecha_pago' => 'nullable|date',
            'notas' => 'required|string|max:255',
            ];
        } else {
            return [
            'cliente_id' => 'required|exists:clientes,id',
            'remesa_id' => 'nullable|exists:remesa,id',
            'fecha_emision' => 'required|date',
            'fecha_pago' => 'nullable|date',
            ];
        }
    }
}