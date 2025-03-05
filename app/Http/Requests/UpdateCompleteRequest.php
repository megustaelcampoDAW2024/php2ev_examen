<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidFechaRealizacion;

class UpdateCompleteRequest extends FormRequest
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
        // Mantener los ficheros al fallar la validación
        // Arreglar segunda validación de fecha
        return [
            'fecha_realizacion' => ['required', 'date', new ValidFechaRealizacion($this->estado)],
            'estado' => 'required|in:B,P,R,C',
            'anotaciones_anteriores' => 'nullable|string',
            'anotaciones_posteriores' => 'nullable|string',
            'fichero' => 'required|file|mimes:pdf|max:2048',
            'foto' => 'required|file|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
