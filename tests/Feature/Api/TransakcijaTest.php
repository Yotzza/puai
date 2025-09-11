<?php

namespace Tests\Feature\Api;

use App\Models\Zaposleni;
use App\Models\Transakcija;

use App\Models\Roba;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransakcijaTest extends TestCase
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
    public function it_gets_transakcijas_list(): void
    {
        $transakcijas = Transakcija::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transakcijas.index'));

        $response->assertOk()->assertSee($transakcijas[0]->datum);
    }

    /**
     * @test
     */
    public function it_stores_the_transakcija(): void
    {
        $data = Transakcija::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.transakcijas.store'), $data);

        $this->assertDatabaseHas('transakcijas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transakcija(): void
    {
        $transakcija = Transakcija::factory()->create();

        $zaposleni = Zaposleni::factory()->create();
        $roba = Roba::factory()->create();

        $data = [
            'zaposleni_id' => $this->faker->randomNumber(),
            'roba_id' => $this->faker->randomNumber(),
            'kolicina' => $this->faker->randomNumber(0),
            'datum' => $this->faker->date(),
            'tip' => $this->faker->text(255),
            'zaposleni_id' => $zaposleni->zaposleni_id,
            'roba_id' => $roba->roba_id,
        ];

        $response = $this->putJson(
            route('api.transakcijas.update', $transakcija),
            $data
        );

        $data['transakcija_id'] = $transakcija->transakcija_id;

        $this->assertDatabaseHas('transakcijas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transakcija(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->deleteJson(
            route('api.transakcijas.destroy', $transakcija)
        );

        $this->assertModelMissing($transakcija);

        $response->assertNoContent();
    }
}
