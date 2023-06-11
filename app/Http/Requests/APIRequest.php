<?php


namespace App\Http\Requests;


use App\Helpers\ResponseErrorHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class APIRequest extends FormRequest
{
    /**
     * If validator fails return the exception in json form
     *
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            (new ResponseErrorHelper(Response::HTTP_UNPROCESSABLE_ENTITY,
                ResponseErrorHelper::TYPE_VALIDATION, $validator->errors()->first()))->toArray(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
