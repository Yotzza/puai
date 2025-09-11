<?php

namespace Tests\Feature\Controllers;

use App\Models\Zaposleni;
use App\Models\Transakcija;

use App\Models\Roba;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransakcijaControllerTest extends TestCase
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
    public function it_displays_index_view_with_transakcijas(): void
    {
        $transakcijas = Transakcija::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('transakcijas.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.transakcijas.index')
            ->assertViewHas('transakcijas');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_transakcija(): void
    {
        $response = $this->get(route('transakcijas.create'));

        $response->assertOk()->assertViewIs('app.transakcijas.create');
    }

    /**
     * @test
     */
    public function it_stores_the_transakcija(): void
    {
        $data = Transakcija::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('transakcijas.store'), $data);

        $this->assertDatabaseHas('transakcijas', $data);

        $transakcija = Transakcija::latest('transakcija_id')->first();

        $response->assertRedirect(route('transakcijas.edit', $transakcija));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_transakcija(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->get(route('transakcijas.show', $transakcija));

        $response
            ->assertOk()
            ->assertViewIs('app.transakcijas.show')
            ->assertViewHas('transakcija');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_transakcija(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->get(route('transakcijas.edit', $transakcija));

        $response
            ->assertOk()
            ->assertViewIs('app.transakcijas.edit')
            ->assertViewHas('transakcija');
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

        $response = $this->put(
            route('transakcijas.update', $transakcija),
            $data
        );

        $data['transakcija_id'] = $transakcija->transakcija_id;

        $this->assertDatabaseHas('transakcijas', $data);

        $response->assertRedirect(route('transakcijas.edit', $transakcija));
    }

    /**
     * @test
     */
    public function it_deletes_the_transakcija(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->delete(route('transakcijas.destroy', $transakcija));

        $response->assertRedirect(route('transakcijas.index'));

        $this->assertModelMissing($transakcija);
    }
}
