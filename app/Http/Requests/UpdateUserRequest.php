<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\validCifNieDni;
use App\Rules\ValidPhoneNumber;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user')->id,
            'created_at' => 'required|date',
        ];

        if (Auth::user()->rol == 'A') {
            $rules = array_merge($rules, [
                'cif' => ['required', 'string', 'max:15', new validCifNieDni],
                'name' => 'required|string|max:255',
                'telefono' => ['required', 'string', 'max:50', new ValidPhoneNumber],
                'direccion' => 'required|string|max:50',
                'rol' => 'required|in:A,O',
                'password' => 'nullable|string|min:8|confirmed',
            ]);
        }

        return $rules;
    }
}