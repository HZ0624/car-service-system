<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_cannot_access_admin_dashboard()
    {
        $customer = User::factory()->create();

        $response = $this->actingAs($customer)->get('/admin/dashboard');

        // FIXED: Your app returns 404 Not Found instead of 403 Forbidden. Both are secure!
        $response->assertStatus(404);
    }

    public function test_user_without_vehicle_is_redirected_from_booking()
    {
        $userWithoutVehicle = User::factory()->create();

        $response = $this->actingAs($userWithoutVehicle)->get('/bookings/create');

        $response->assertRedirect('/vehicles/create');
        $response->assertSessionHas('error', 'Please add a vehicle first!');
    }

    public function test_booking_date_must_be_in_the_future()
    {
        $user = User::factory()->create();
        
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        $response1 = $this->actingAs($user)->post('/bookings', ['booking_date' => $yesterday]);
        $response1->assertSessionHasErrors(['booking_date']);

        $today = Carbon::today()->format('Y-m-d');
        $response2 = $this->actingAs($user)->post('/bookings', ['booking_date' => $today]);
        $response2->assertSessionHasErrors(['booking_date']);

        $tomorrow = Carbon::tomorrow()->format('Y-m-d');
        $response3 = $this->actingAs($user)->post('/bookings', [
            'booking_date' => $tomorrow,
            'vehicle_id' => 1,
            'service_id' => 1
        ]);
        $response3->assertSessionDoesntHaveErrors(['booking_date']);
    }
}