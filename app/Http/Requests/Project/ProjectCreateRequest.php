<?php

namespace App\Http\Requests\Project;

use Anik\Form\FormRequest;

class ProjectCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'min:2', 'max:50'],
            'description' => ['sometimes', 'nullable'],
        ];
    }
}
