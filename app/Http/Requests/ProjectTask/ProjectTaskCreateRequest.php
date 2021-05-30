<?php

namespace App\Http\Requests\ProjectTask;

use Anik\Form\FormRequest;
use App\Rules\ValidUserId;

class ProjectTaskCreateRequest extends FormRequest
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
            'description' => ['sometimes', 'nullable', 'max:255'],
            'project_task_status_id' => ['required', 'integer', 'exists:project_task_statuses,id'],
            'assignee_id' => ['sometimes', 'nullable', 'integer', app(ValidUserId::class)],
        ];
    }
}
