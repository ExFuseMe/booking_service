<?php

namespace App\Swagger\Requests;

/**
 * @OA\Schema (required={"resource_id", "start_time", "end_time"})
 */
class StoreBookingRequestSchema
{
    /**
     * @OA\Property ()
     */
    public int $resource_id;

    /**
     * @OA\Property (example="2025-03-27 08:59:34")
     */
    public string $start_time;

    /**
     * @OA\Property (example="2025-03-28 08:59:34")
     */
    public string $end_time;
}
