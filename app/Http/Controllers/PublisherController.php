<?php

namespace App\Http\Controllers;

use App\Business\Publisher\PublisherBusiness;
use App\Exceptions\ValidationException;
use App\Helpers\ResponseErrorHelper;
use App\Http\Requests\Publisher\PublisherValidations;
use App\Http\Requests\Publisher\StorePublisherRequest;
use App\Http\Requests\Publisher\UpdatePublisherRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PublisherController extends Controller
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
            return response()->json(PublisherBusiness::list($request->all()));
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePublisherRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePublisherRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            PublisherBusiness::create($validated);

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
     * @param Publisher $publisher
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function show(Publisher $publisher): \Illuminate\Http\JsonResponse|array
    {
        try {
            return $publisher->only(['id', 'name', 'full_name']);
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePublisherRequest $request
     * @param Publisher $publisher
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function update(UpdatePublisherRequest $request, Publisher $publisher): Response|\Illuminate\Http\JsonResponse
    {
        try {
            // Retrieve the validated input data...
            $validated = $request->validated();

            if (!empty($validated['full_name']) && $errorMessage =
                    PublisherValidations::checkIfPublisherExistsByFullName($validated['full_name'], $publisher->id)) {
                throw new ValidationException($errorMessage);
            }

            PublisherBusiness::update($publisher, $validated);

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
     * @param Publisher $publisher
     * @return \Illuminate\Http\JsonResponse|Response
     */
    public function destroy(Publisher $publisher): Response|\Illuminate\Http\JsonResponse
    {
        try {
            PublisherBusiness::softDelete($publisher);

            return response()->noContent();
        } catch (\Exception $e) {
            $responseError = new ResponseErrorHelper();
            $responseError->setData((self::isShowExceptionMessage()) ? $e->getMessage() : []);
        }

        return response()->json($responseError->toArray(), $responseError->getStatus());
    }
}
