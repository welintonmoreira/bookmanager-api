<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\APIRequest;
use Illuminate\Validation\Validator;

class StoreBookRequest extends APIRequest
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
            'create_even_if_record_exists' => 'nullable|boolean',
            'title' => 'required|string|min:2|max:255',
            'original_title' => 'nullable|string|min:2|max:255',
            'subtitle' => 'nullable|string|min:2|max:255',
            'original_subtitle' => 'nullable|string|min:2|max:255',
            'publication_year' => 'nullable|int',
            'number_pages' => 'nullable|int',
            'edition_number' => 'required|int',
            'synopsis' => 'nullable|min:2|max:5000',
            'height' => 'nullable|int',
            'width' => 'nullable|int',
            'thickness' => 'nullable|int',
            'weight' => 'nullable|int',
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
                if (empty($this->input('create_even_if_record_exists'))) {
                    $title = $this->input('title');

                    if (!empty($title) && $message = BookValidations::checkIfBookExistsByTitle($title)) {
                        $validator->errors()->add('title', $message);
                    }
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
        return [
            'publication_year' => "year of publication",
            'number_pages' => "number of pages",
            'height' => "height (millimeters)",
            'width' => "width (millimeters)",
            'thickness' => "thickness (millimeters)",
            'weight' => "weight (grams)",
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
