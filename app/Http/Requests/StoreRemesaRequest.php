<?php

namespace App\Http\Requests;

use App\Models\Remesa;
use Illuminate\Foundation\Http\FormRequest;

class StoreRemesaRequest extends FormRequest
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
            'mes' => 'required|integer|min:1|max:12',
            'ano' => 'required|integer|min:2000|max:2100',
            'descripcion' => 'nullable|string|max:255',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($this->isMethod('post')) { // Check if the request method is POST (creating a new remesa)
            $validator->after(function ($validator) {
                if (Remesa::where('mes', $this->mes)->where('ano', $this->ano)->first()) {
                    $validator->errors()->add('unique_remesa', 'A remesa with the same month and year already exists.');
                }
            });
        }
    }
}
