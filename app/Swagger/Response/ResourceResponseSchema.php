<?php

namespace App\Swagger\Response;
/**
 * @OA\Schema ()
 */
class ResourceResponseSchema
{
    /**
     * @OA\Property ()
     */
    public int $id;
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
