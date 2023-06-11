<?php

namespace App\Http\Controllers;

use App\Business\Author\AuthorBusiness;
use App\Exceptions\ValidationException;
use App\Helpers\ResponseErrorHelper;
use App\Http\Requests\Author\AuthorValidations;
use App\Http\Requests\Author\StoreAuthorRequest;
use App\Http\Requests\Author\UpdateAuthorRequest;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json(AuthorBusiness::list($request->all()));
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((env('SHOW_EXCEPTION_MESSAGE')) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            AuthorBusiness::create($validated);

            return response()->json([], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((env('SHOW_EXCEPTION_MESSAGE')) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Display the specified resource.
     *
     * @param Author $author
     * @return array
     */
    public function show(Author $author): array
    {
        return $author->only(['id', 'name']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAuthorRequest $request
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function update(UpdateAuthorRequest $request, Author $author): Response|\Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            if ($errorMessage = AuthorValidations::checkIfAuthorExistsByName($validated['name'], $author->id)) {
                throw new ValidationException($errorMessage);
            }

            AuthorBusiness::update($author, $validated);

            return response()->noContent();
        } catch (ValidationException $e) {
            $responseError = new ResponseErrorHelper(Response::HTTP_UNPROCESSABLE_ENTITY,
                ResponseErrorHelper::TYPE_VALIDATION, $e->getMessage());

        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((env('SHOW_EXCEPTION_MESSAGE')) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Author $author
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function destroy(Author $author): Response|\Illuminate\Http\JsonResponse
    {
        try {
            AuthorBusiness::softDelete($author);

            return response()->noContent();
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((env('SHOW_EXCEPTION_MESSAGE')) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }
}
