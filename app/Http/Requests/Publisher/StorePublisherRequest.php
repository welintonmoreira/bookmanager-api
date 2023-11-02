<?php

namespace App\Http\Requests\Publisher;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Validator;

class StorePublisherRequest extends APIRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

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
            'name' => 'required|string|min:2|max:255',
            'full_name' => 'required|string|min:2|max:255',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     *
     * @param Validator $validator
     * @return array|\Closure
     */
    public function after(Validator $validator): array|\Closure
    {
        if ($validator->fails()) {
            return [];
        }

        return [
            function () use ($validator) {
                if ($message = PublisherValidations::checkIfPublisherExistsByFullName($this->input('full_name'))) {
                    $validator->errors()->add('full_name', $message);
                }
            }
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [];
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
