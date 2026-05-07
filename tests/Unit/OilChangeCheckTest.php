<?php

namespace Tests\Unit;

use App\Models\OilChangeCheck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OilChangeCheckTest extends TestCase
{
    use RefreshDatabase;

    public function test_example(): void
    {
        // Now 'oil_change_checks' table will exist!
        $check = OilChangeCheck::factory()->create();

        $this->assertInstanceOf(OilChangeCheck::class, $check);
    }
}
