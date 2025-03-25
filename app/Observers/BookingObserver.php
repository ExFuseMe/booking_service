<?php

namespace App\Observers;

use App\Models\Booking;
use App\Notifications\BookingCreatedNotification;
use App\Notifications\BookingDeletedNotification;
use Illuminate\Support\Facades\Notification;

class BookingObserver
{
    public function created(Booking $booking): void
    {
        Notification::send($booking->user, new BookingCreatedNotification($booking));
    }

    public function deleted(Booking $booking): void
    {
        Notification::send($booking->user, new BookingDeletedNotification($booking));
    }
}
