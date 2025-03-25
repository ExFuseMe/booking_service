<?php

namespace App\Swagger\Response;

/**
 * @OA\Schema ()
 */
class BookingResponseSchema
{
    /**
     * @OA\Property ()
     */
    public int $id;

    /**
     * @OA\Property ()
     */
    public string $start_time;

    /**
     * @OA\Property ()
     */
    public string $end_time;
}
