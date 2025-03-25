<?php

namespace Tests\Feature;

use App\Models\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $response = $this->post('/api/login', [
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);
        $this->token = $response->json('token');
    }

    public function testBookingCreating()
    {
        $resourceId = Resource::all()->random()->id;
        $response = $this->post('/api/bookings', [
            'resource_id' => $resourceId,
            'start_time' => '2026-04-27 08:59:34',
            'end_time' => '2026-04-28 09:00:34',
        ]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('bookings', [
            'resource_id' => $resourceId,
            'start_time' => '2026-04-27 08:59:34',
            'end_time' => '2026-04-28 09:00:34',
        ]);
    }
}
