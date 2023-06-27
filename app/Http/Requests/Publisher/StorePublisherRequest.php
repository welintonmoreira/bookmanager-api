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
            'name' => 'required|string|min:2|max:255',
            'full_name' => 'required|string|min:2|max:255',
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     *
     * @return \Closure|array
     */
    public function after(): array|\Closure
    {
        return [
            function (Validator $validator) {
                $fullName = $this->input('full_name');

                if (!empty($fullName) && $message = PublisherValidations::checkIfPublisherExistsByFullName($fullName)) {
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
