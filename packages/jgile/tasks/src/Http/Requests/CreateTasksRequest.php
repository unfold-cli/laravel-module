<?php

namespace Jgile\Tasks\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Jgile\Tasks\Models\Tasks;

class CreateTasksRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', Tasks::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // fields
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
