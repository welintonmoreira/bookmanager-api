<?php

namespace App\Http\Requests\BookPublisher;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Validator;

class StoreBookPublisherRequest extends APIRequest
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
            'book_id' => 'required|int',
            'publisher_id' => 'required|int',
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
                if ($message = BookPublisherValidations::checkIfPublisherIsLinked($this->input('book_id'), $this->input('publisher_id'))) {
                    $validator->errors()->add('publisher_id', $message);
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
