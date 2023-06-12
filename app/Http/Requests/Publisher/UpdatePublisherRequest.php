<?php

namespace App\Http\Requests\Publisher;

use App\Http\Requests\APIRequest;

class UpdatePublisherRequest extends APIRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected bool $stopOnFirstFailure = true;

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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'min:2|max:255',
            'full_name' => 'min:2|max:255',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     *
     * @return \Closure|array
     */
    public function after(): array|\Closure
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => "publisher's name",
            'full_name' => "publisher's full name",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [];
    }
}
