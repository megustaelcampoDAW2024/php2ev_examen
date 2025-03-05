<?php

namespace App\Http\Requests;

use App\Rules\validCifNieDni;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidPhoneNumber;
use App\Rules\ValidCodigoPostal;
use App\Rules\ValidCifTelefono;

class StoreRequest extends FormRequest
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
        return [
            'cif' => ['required', 'string', 'max:9', new validCifNieDni,  new ValidCifTelefono],
            'telefono' => ['required', 'string', 'max:50', new ValidPhoneNumber, new ValidCifTelefono],
            'nombre_contacto' => 'required|string|max:255',
            'apellido_contacto' => 'required|string|max:255',
            'correo_contacto' => 'required|email|max:255',
            'telefono_contacto' => ['required', 'string', 'max:50', new ValidPhoneNumber],
            'descripcion' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'poblacion' => 'nullable|string|max:255',
            'cod_postal' => ['nullable', 'numeric', 'digits:5', new validCodigoPostal($this->provincia_id)],
            'provincia_id' => 'nullable|exists:tbl_provincias,id',
        ];
    }
}