<?php

namespace Tests\Feature\Api;

use App\Models\Roba;
use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RobaTest extends TestCase
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
    public function it_gets_robas_list(): void
    {
        $robas = Roba::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.robas.index'));

        $response->assertOk()->assertSee($robas[0]->naziv);
    }

    /**
     * @test
     */
    public function it_stores_the_roba(): void
    {
        $data = Roba::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.robas.store'), $data);

        $this->assertDatabaseHas('robas', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_roba(): void
    {
        $roba = Roba::factory()->create();

        $data = [
            'naziv' => $this->faker->text(255),
            'sifra' => $this->faker->text(255),
            'opis' => $this->faker->text(255),
            'kolicina' => $this->faker->randomNumber(0),
            'lokacija' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.robas.update', $roba), $data);

        $data['roba_id'] = $roba->roba_id;

        $this->assertDatabaseHas('robas', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_roba(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->deleteJson(route('api.robas.destroy', $roba));

        $this->assertModelMissing($roba);

        $response->assertNoContent();
    }
}
