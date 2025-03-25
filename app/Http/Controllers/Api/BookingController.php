<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;

class BookingController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Создание аренды",
     *     tags={"Bookings"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\RequestBody(
     *           required=true,
     *           @OA\MediaType(
     *                mediaType="multipart/form-data",
     *                @OA\Schema(ref="#/components/schemas/StoreBookingRequestSchema",),
     *           ),
     *      ),
     *     @OA\Response(response="201", description="Succesful", @OA\JsonContent(
     *         ref="#/components/schemas/BookingResponseSchema"
     *     )),
     *     @OA\Response(response="401", description="Invalid credentials")
     * ),
     */
    public function store(StoreBookingRequest $request, BookingService $bookingService)
    {
        $booking = $bookingService->create($request);

        return new BookingResource($booking);
    }


    /**
     * @OA\Delete(
     *     path="/api/bookings/{booking}",
     *     summary="Удаление аренды",
     *     tags={"Bookings"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter (
     *            name="booking",
     *            in="path",
     *                required=true,
     *       ),
     *     @OA\Response(response="204", description="Succesful", @OA\JsonContent()),
     * ),
     */
    public function destroy(Booking $booking, BookingService $bookingService)
    {
        $bookingService->delete($booking);
        return response(null, 204);
    }
}
