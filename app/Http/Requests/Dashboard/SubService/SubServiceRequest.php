<?php

namespace App\Http\Requests\Dashboard\SubService;

use Illuminate\Foundation\Http\FormRequest;

class SubServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'name'=>'string',
           'service_id'=>'required'
        ];
    }
}
