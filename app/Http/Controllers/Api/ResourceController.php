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

    public function index()
    {
        $resources = $this->resourceRepository->getResourceList();
        return ResourceResource::collection($resources);
    }

    public function store(StoreResourceRequest $request)
    {
        $validated = $request->validated();
        $resource = Resource::create($validated);
        return new ResourceResource($resource);
    }

    public function resourceBookings(Resource $resource, BookingRepository $bookingRepository)
    {
        $bookings = $bookingRepository->getResourceBookings($resource->id);

        return BookingResource::collection($bookings);
    }
}
