<?php

namespace Tests\Feature\Api;

use App\Models\Izvestaj;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniIzvestajsTest extends TestCase
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
    public function it_gets_zaposleni_izvestajs(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $izvestajs = Izvestaj::factory()
            ->count(2)
            ->create([
                'zaposleni_id' => $zaposleni->zaposleni_id,
            ]);

        $response = $this->getJson(
            route('api.zaposlenis.izvestajs.index', $zaposleni)
        );

        $response->assertOk()->assertSee($izvestajs[0]->opis);
    }

    /**
     * @test
     */
    public function it_stores_the_zaposleni_izvestajs(): void
    {
        $zaposleni = Zaposleni::factory()->create();
        $data = Izvestaj::factory()
            ->make([
                'zaposleni_id' => $zaposleni->zaposleni_id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.zaposlenis.izvestajs.store', $zaposleni),
            $data
        );

        $this->assertDatabaseHas('izvestajs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $izvestaj = Izvestaj::latest('izvestaj_id')->first();

        $this->assertEquals($zaposleni->zaposleni_id, $izvestaj->zaposleni_id);
    }
}
