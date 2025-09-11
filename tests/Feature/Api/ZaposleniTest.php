<?php

namespace Tests\Feature\Api;

use App\Models\Zaposleni;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniTest extends TestCase
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
    public function it_gets_zaposlenis_list(): void
    {
        $zaposlenis = Zaposleni::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.zaposlenis.index'));

        $response->assertOk()->assertSee($zaposlenis[0]->ime);
    }

    /**
     * @test
     */
    public function it_stores_the_zaposleni(): void
    {
        $data = Zaposleni::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(route('api.zaposlenis.store'), $data);

        unset($data['password']);
        unset($data['prezime']);

        $this->assertDatabaseHas('zaposlenis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $data = [
            'ime' => $this->faker->name(),
            'username' => $this->faker->text(255),
        ];

        $data['password'] = \Str::random('8');

        $response = $this->putJson(
            route('api.zaposlenis.update', $zaposleni),
            $data
        );

        unset($data['password']);
        unset($data['prezime']);

        $data['zaposleni_id'] = $zaposleni->zaposleni_id;

        $this->assertDatabaseHas('zaposlenis', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->deleteJson(
            route('api.zaposlenis.destroy', $zaposleni)
        );

        $this->assertModelMissing($zaposleni);

        $response->assertNoContent();
    }
}
