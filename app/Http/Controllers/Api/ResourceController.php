<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repositories\BookingRepository;
use App\Http\Repositories\ResourceRepository;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\BookingResource;
use App\Http\Resources\ResourceResource;
use App\Models\Resource;

class ResourceController extends Controller
{
    private ResourceRepository $resourceRepository;

    public function __construct()
    {
        $this->resourceRepository = new ResourceRepository();
    }
    /**
     * @OA\Get (
     *     path="/api/resources",
     *     summary="Получение списка ресурсов",
     *     tags={"Resources"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Response(response="200", description="Всё ок", @OA\JsonContent(
     *           @OA\Property (
     *                type="array",
     *                property="data",
     *                @OA\Items(ref="#/components/schemas/ResourceResponseSchema")
     *           ),
     *       ))
     * ),
     */
    public function index()
    {
        $resources = $this->resourceRepository->getResourceList();
        return ResourceResource::collection($resources);
    }

    /**
     * @OA\Post(
     *     path="/api/resources",
     *     summary="Создание ресурса",
     *     tags={"Resources"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                @OA\Schema(ref="#/components/schemas/StoreResourceRequestSchema",),
     *           ),
     *      ),
     *     @OA\Response(response="201", description="Succesful", @OA\JsonContent(
     *         ref="#/components/schemas/ResourceResponseSchema"
     *     )),
     *     @OA\Response(response="401", description="Invalid credentials")
     * ),
     */
    public function store(StoreResourceRequest $request)
    {
        $validated = $request->validated();
        $resource = Resource::create($validated);
        return new ResourceResource($resource);
    }


    /**
     * @OA\Get(
     *     path="/api/resources/{resource}/bookings",
     *     summary="Получение аренд ресурса",
     *     tags={"Resources"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter (
     *            name="resource",
     *            in="path",
     *                required=true,
     *       ),
     *     @OA\Response(response="200", description="Всё ок", @OA\JsonContent(
     *            @OA\Property (
     *                 type="array",
     *                 property="data",
     *                 @OA\Items(ref="#/components/schemas/ResourceResponseSchema")
     *            ),
     *        ))
     * ),
     */
    public function resourceBookings(Resource $resource, BookingRepository $bookingRepository)
    {
        $bookings = $bookingRepository->getResourceBookings($resource->id);

        return BookingResource::collection($bookings);
    }
}
