<?php

namespace App\Http\Requests;

use App\Rules\validCifNieDni;
use App\Rules\ValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'cif' => ['required', 'string', 'max:15', new validCifNieDni],
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => ['required', 'string', 'max:50', new ValidPhoneNumber],
            'direccion' => 'required|string|max:50',
            'rol' => 'required|in:A,O',
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
