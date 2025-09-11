<?php

namespace Tests\Feature\Api;

use App\Models\Izvestaj;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IzvestajTest extends TestCase
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
    public function it_gets_izvestajs_list(): void
    {
        $izvestajs = Izvestaj::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.izvestajs.index'));

        $response->assertOk()->assertSee($izvestajs[0]->opis);
    }

    /**
     * @test
     */
    public function it_stores_the_izvestaj(): void
    {
        $data = Izvestaj::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.izvestajs.store'), $data);

        $this->assertDatabaseHas('izvestajs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_izvestaj(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $zaposleni = Zaposleni::factory()->create();

        $data = [
            'zaposleni_id' => $this->faker->randomNumber(),
            'opis' => $this->faker->text(255),
            'datum' => $this->faker->date(),
            'tip' => $this->faker->text(255),
            'zaposleni_id' => $zaposleni->zaposleni_id,
        ];

        $response = $this->putJson(
            route('api.izvestajs.update', $izvestaj),
            $data
        );

        $data['izvestaj_id'] = $izvestaj->izvestaj_id;

        $this->assertDatabaseHas('izvestajs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_izvestaj(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->deleteJson(
            route('api.izvestajs.destroy', $izvestaj)
        );

        $this->assertModelMissing($izvestaj);

        $response->assertNoContent();
    }
}
