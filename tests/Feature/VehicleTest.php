<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Vehicle;

class VehicleTest extends TestCase
{
    use RefreshDatabase; 

    public function test_system_rejects_duplicate_license_plates()
    {
        $user = User::factory()->create();
        
        Vehicle::create([
            'user_id' => $user->id,
            'license_plate' => 'PHW 8883',
            'make' => 'Toyota',
            'model' => 'Camry',
            'year' => 2020
        ]);

        $response = $this->actingAs($user)->post('/vehicles', [
            'license_plate' => 'PHW 8883', 
            'make' => 'Honda',
            'model' => 'Civic',
            'year' => 2022
        ]);

        $response->assertSessionHasErrors(['license_plate']);
    }

    public function test_vehicle_year_respects_boundary_values()
    {
        $user = User::factory()->create();
        $currentYear = (int) date('Y');

        // 1. Upper Boundary (Valid: Current Year)
        $response1 = $this->actingAs($user)->post('/vehicles', [
            'license_plate' => 'BBB 2222',
            'make' => 'Toyota',
            'model' => 'Vios',
            'year' => $currentYear 
        ]);
        $response1->assertSessionHasNoErrors();

        // 2. Lower Boundary Edge (Invalid: Too old)
        $response2 = $this->actingAs($user)->post('/vehicles', [
            'license_plate' => 'CCC 3333',
            'make' => 'Honda',
            'model' => 'City',
            'year' => 1885 
        ]);
        $response2->assertSessionHasErrors(['year']);
    }
}