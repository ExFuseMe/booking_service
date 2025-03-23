<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function store(StoreBookingRequest $request, BookingService $bookingService)
    {
        $booking = $bookingService->create($request);

        return new BookingResource($booking);
    }

    public function destroy(Booking $booking, BookingService $bookingService)
    {
        $bookingService->delete($booking);
    }
}
