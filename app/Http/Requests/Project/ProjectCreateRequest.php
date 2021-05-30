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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:50'],
            'description' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
