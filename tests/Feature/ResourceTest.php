<?php

namespace Tests\Feature;

use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    public string $token;

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);
        $this->token = $response->json('token');
    }

    public function testLogin(): void
    {
        $this->assertNotEmpty($this->token, 'Token should not be empty');
    }

    public function testResourceList(): void
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->get('/api/resources');

        $response->assertStatus(200);
    }

    public function testResourceCreating()
    {
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->post('/api/resources', [
                'name' => 'Test Resource',
                'description' => 'Test Resource Description',
                'type' => 'Test Resource Type',
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('resources', ['name' => 'Test Resource', 'description' => 'Test Resource Description', 'type' => 'Test Resource Type']);
    }

    public function testResourceBookings()
    {
        $resourceId = Resource::all()->random()->id;
        $response = $this->withHeader('Authorization', 'Bearer ' . $this->token)
            ->get("/api/resources/{$resourceId}/bookings");

        $response->assertStatus(200);
    }
}
