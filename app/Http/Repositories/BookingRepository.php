<?php

namespace App\Http\Repositories;

use App\Models\Booking as Model;

class BookingRepository extends CoreRepository
{
    function getModelClass(): string
    {
        return Model::class;
    }

    public function getResourceBookings(int $resourceId)
    {
        $result = $this->startConditions()
            ->where('resource_id', $resourceId)
            ->get();

        return $result;
    }

    public function isBookingAvailable(int $resourceId, string $start_time, string $end_time): bool
    {
        $result = $this->startConditions()
            ->where('resource_id', $resourceId)
            ->where(function ($query) use ($start_time, $end_time) {
                $query->whereBetween('start_time', [$start_time, $end_time])
                    ->orWhereBetween('end_time', [$start_time, $end_time])
                    ->orWhere(function ($q) use ($start_time, $end_time) {
                        $q->where('start_time', '<=', $start_time)
                            ->where('end_time', '>=', $end_time);
                    });
            })
            ->get();

        return count($result) == 0;
    }
}
