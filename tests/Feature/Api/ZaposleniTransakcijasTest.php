<?php

namespace Tests\Feature\Api;

use App\Models\Zaposleni;
use App\Models\Transakcija;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniTransakcijasTest extends TestCase
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
    public function it_gets_zaposleni_transakcijas(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $transakcijas = Transakcija::factory()
            ->count(2)
            ->create([
                'zaposleni_id' => $zaposleni->zaposleni_id,
            ]);

        $response = $this->getJson(
            route('api.zaposlenis.transakcijas.index', $zaposleni)
        );

        $response->assertOk()->assertSee($transakcijas[0]->datum);
    }

    /**
     * @test
     */
    public function it_stores_the_zaposleni_transakcijas(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $data = Transakcija::factory()
            ->make([
                'zaposleni_id' => $zaposleni->zaposleni_id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.zaposlenis.transakcijas.store', $zaposleni),
            $data
        );

        $this->assertDatabaseHas('transakcijas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $transakcija = Transakcija::latest('transakcija_id')->first();

        $this->assertEquals(
            $zaposleni->zaposleni_id,
            $transakcija->zaposleni_id
        );
    }
}
