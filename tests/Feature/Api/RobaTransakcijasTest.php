<?php

namespace Tests\Feature\Api;

use App\Models\Roba;
use App\Models\Zaposleni;
use App\Models\Transakcija;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RobaTransakcijasTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = Zaposleni::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_roba_transakcijas(): void
    {
        $roba = Roba::factory()->create();
        $transakcijas = Transakcija::factory()
            ->count(2)
            ->create([
                'roba_id' => $roba->roba_id,
            ]);

        $response = $this->getJson(
            route('api.robas.transakcijas.index', $roba)
        );

        $response->assertOk()->assertSee($transakcijas[0]->datum);
    }

    /**
     * @test
     */
    public function it_stores_the_roba_transakcijas(): void
    {
        $roba = Roba::factory()->create();
        $data = Transakcija::factory()
            ->make([
                'roba_id' => $roba->roba_id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.robas.transakcijas.store', $roba),
            $data
        );

        $this->assertDatabaseHas('transakcijas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transakcija = Transakcija::latest('transakcija_id')->first();

        $this->assertEquals($roba->roba_id, $transakcija->roba_id);
    }
}
