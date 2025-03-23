<?php

namespace App\Services;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class BookingService
{
    public function create(StoreBookingRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();


        $booking = Booking::create($validated);
        return $booking;
    }

    public function delete(Booking $booking): void
    {
        if (auth()->id() !== $booking->user_id){
            throw new AccessDeniedHttpException("Нельзя отменить чужую аренду");
        }
        $booking->delete();
    }
}
