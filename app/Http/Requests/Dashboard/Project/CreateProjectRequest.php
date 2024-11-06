<?php

namespace App\Http\Requests\Dashboard\Project;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
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
          'title'=>'required',
          'introduction'=>'required',
          'category_id'=>'required',
          'scope_id'=>'required',
          'year_id'=>'required',
          'scale_id'=>'required',
          'status_id'=>'required',
          'input_img'=>'required',
        //   'owner'=>'required',
        //   'location'=>'required',
        ];
    }
}
