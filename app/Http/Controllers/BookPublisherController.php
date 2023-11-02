<?php

namespace App\Http\Controllers;

use App\Business\BookPublisher\BookPublisherBusiness;
use App\Helpers\ResponseErrorHelper;
use App\Http\Requests\BookPublisher\StoreBookPublisherRequest;
use App\Models\BookPublisher;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookPublisherController extends Controller
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
            return response()->json(BookPublisherBusiness::list($request->all()));
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookPublisherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookPublisherRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            BookPublisherBusiness::create($validated);

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
     * @param BookPublisher $bookPublisher
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(BookPublisher $bookPublisher): Response|\Illuminate\Http\JsonResponse
    {
        try {
            BookPublisherBusiness::softDelete($bookPublisher);

            return response()->noContent();
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }
}
