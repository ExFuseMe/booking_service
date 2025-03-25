<?php

namespace App\Swagger\Requests;

/**
 * @OA\Schema (required={"email", "password"})
 */
class AuthRequestSchema
{
    /**
     * @OA\Property ()
     */
    public string $email;
    /**
     * @OA\Property ()
     */
    public string $password;
}
