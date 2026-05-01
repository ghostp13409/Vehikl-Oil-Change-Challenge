<?php

namespace Tests\Feature;

use App\Models\OilChangeCheck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class OilChangeTest extends TestCase
{
    use RefreshDatabase;

    public function test_form_is_accessible()
    {
        $response = $this->get("/");
        $response->assertStatus(200);
        $response->assertSee("Oil Change Check");
    }

    public function test_validation_fails_if_fields_are_missing()
    {
        $response = $this->post("/check", []);
        $response->assertSessionHasErrors([
            "current_odometer",
            "previous_oil_change_date",
            "previous_oil_change_odometer",
        ]);
    }

    public function test_validation_fails_if_current_odometer_is_less_than_previous()
    {
        $response = $this->post("/check", [
            "current_odometer" => 1000,
            "previous_oil_change_date" => "2023-01-01",
            "previous_oil_change_odometer" => 2000,
        ]);
        $response->assertSessionHasErrors(["current_odometer"]);
    }

    public function test_validation_fails_if_date_is_in_the_future()
    {
        $response = $this->post("/check", [
            "current_odometer" => 3000,
            "previous_oil_change_date" => Carbon::tomorrow()->toDateString(),
            "previous_oil_change_odometer" => 2000,
        ]);
        $response->assertSessionHasErrors(["previous_oil_change_date"]);
    }

    public function test_due_for_oil_change_by_distance()
    {
        $response = $this->post("/check", [
            "current_odometer" => 7001,
            "previous_oil_change_date" => Carbon::now()
                ->subMonths(1)
                ->toDateString(),
            "previous_oil_change_odometer" => 2000,
        ]);

        $check = OilChangeCheck::first();
        $this->assertTrue($check->is_due);
        $response->assertRedirect(route("result", ["id" => $check->id]));
    }

    public function test_due_for_oil_change_by_time()
    {
        $response = $this->post("/check", [
            "current_odometer" => 3000,
            "previous_oil_change_date" => Carbon::now()
                ->subMonths(7)
                ->toDateString(),
            "previous_oil_change_odometer" => 2000,
        ]);

        $check = OilChangeCheck::first();
        $this->assertTrue($check->is_due);
        $response->assertRedirect(route("result", ["id" => $check->id]));
    }

    public function test_not_due_for_oil_change()
    {
        $response = $this->post("/check", [
            "current_odometer" => 6000,
            "previous_oil_change_date" => Carbon::now()
                ->subMonths(5)
                ->toDateString(),
            "previous_oil_change_odometer" => 2000,
        ]);

        $check = OilChangeCheck::first();
        $this->assertFalse($check->is_due);
        $response->assertRedirect(route("result", ["id" => $check->id]));
    }

    public function test_result_page_shows_correct_data()
    {
        $check = OilChangeCheck::create([
            "current_odometer" => 6000,
            "previous_oil_change_date" => "2023-05-01",
            "previous_oil_change_odometer" => 2000,
            "is_due" => true,
        ]);

        $response = $this->get(route("result", ["id" => $check->id]));
        $response->assertStatus(200);
        $response->assertSee("Your car is due for an oil change.");
        $response->assertSee("6000 km");
        $response->assertSee("2023-05-01");
        $response->assertSee("2000 km");
    }
}
