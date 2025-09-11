<?php

namespace Tests\Feature\Controllers;

use App\Models\Roba;
use App\Models\Zaposleni;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RobaControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            Zaposleni::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_robas(): void
    {
        $robas = Roba::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('robas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.robas.index')
            ->assertViewHas('robas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_roba(): void
    {
        $response = $this->get(route('robas.create'));

        $response->assertOk()->assertViewIs('app.robas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_roba(): void
    {
        $data = Roba::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('robas.store'), $data);

        $this->assertDatabaseHas('robas', $data);

        $roba = Roba::latest('roba_id')->first();

        $response->assertRedirect(route('robas.edit', $roba));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_roba(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->get(route('robas.show', $roba));

        $response
            ->assertOk()
            ->assertViewIs('app.robas.show')
            ->assertViewHas('roba');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_roba(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->get(route('robas.edit', $roba));

        $response
            ->assertOk()
            ->assertViewIs('app.robas.edit')
            ->assertViewHas('roba');
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

        $response = $this->put(route('robas.update', $roba), $data);

        $data['roba_id'] = $roba->roba_id;

        $this->assertDatabaseHas('robas', $data);

        $response->assertRedirect(route('robas.edit', $roba));
    }

    /**
     * @test
     */
    public function it_deletes_the_roba(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->delete(route('robas.destroy', $roba));

        $response->assertRedirect(route('robas.index'));

        $this->assertModelMissing($roba);
    }
}
