<?php

namespace App\Http\Controllers;

use App\Business\Book\BookBusiness;
use App\Exceptions\ValidationException;
use App\Helpers\ResponseErrorHelper;
use App\Http\Requests\Book\BookValidations;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
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
            return response()->json(BookBusiness::list($request->all()));
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            BookBusiness::create($validated);

            return response()->json([], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse|array
     */
    public function show(Book $book): \Illuminate\Http\JsonResponse|array
    {
        try {
            return $book->only([
                'id',
                'title',
                'original_title',
                'subtitle',
                'original_subtitle',
                'publication_year',
                'number_pages',
                'edition_number',
                'synopsis',
                'height',
                'width',
                'thickness',
                'weight'
            ]);
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function update(UpdateBookRequest $request, Book $book): Response|\Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            if (!empty($validated['title']) && empty($validated['update_even_if_record_exists'])
                && $errorMessage = BookValidations::checkIfBookExistsByTitle($validated['title'], $book->id)) {
                throw new ValidationException($errorMessage);
            }

            BookBusiness::update($book, $validated);

            return response()->noContent();
        } catch (ValidationException $e) {
            $responseError = new ResponseErrorHelper(Response::HTTP_UNPROCESSABLE_ENTITY,
                ResponseErrorHelper::TYPE_VALIDATION, $e->getMessage());

        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function destroy(Book $book): Response|\Illuminate\Http\JsonResponse
    {
        try {
            BookBusiness::softDelete($book);

            return response()->noContent();
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }
}
