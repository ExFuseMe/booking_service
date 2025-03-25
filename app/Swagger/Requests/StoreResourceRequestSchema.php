<?php

namespace App\Swagger\Requests;

/**
 * @OA\Schema (required={"name", "type", "description"})
 */
class StoreResourceRequestSchema
{
    /**
     * @OA\Property ()
     */
    public string $name;

    /**
     * @OA\Property ()
     */
    public string $type;

    /**
     * @OA\Property ()
     */
    public string $description;
}
