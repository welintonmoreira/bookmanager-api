<?php

namespace App\Http\Controllers;

use App\Business\BookAuthor\BookAuthorBusiness;
use App\Helpers\ResponseErrorHelper;
use App\Http\Requests\BookAuthor\StoreBookAuthorRequest;
use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookAuthorController extends Controller
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
            return response()->json(BookAuthorBusiness::list($request->all()));
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookAuthorRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            BookAuthorBusiness::create($validated);

            return response()->json([], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BookAuthor $bookAuthor
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(BookAuthor $bookAuthor): Response|\Illuminate\Http\JsonResponse
    {
        try {
            BookAuthorBusiness::softDelete($bookAuthor);

            return response()->noContent();
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }
}
