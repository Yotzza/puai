<?php

namespace Tests\Feature\Controllers;

use App\Models\Izvestaj;
use App\Models\Zaposleni;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IzvestajControllerTest extends TestCase
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
    public function it_displays_index_view_with_izvestajs(): void
    {
        $izvestajs = Izvestaj::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('izvestajs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.izvestajs.index')
            ->assertViewHas('izvestajs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_izvestaj(): void
    {
        $response = $this->get(route('izvestajs.create'));

        $response->assertOk()->assertViewIs('app.izvestajs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_izvestaj(): void
    {
        $data = Izvestaj::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('izvestajs.store'), $data);

        $this->assertDatabaseHas('izvestajs', $data);

        $izvestaj = Izvestaj::latest('izvestaj_id')->first();

        $response->assertRedirect(route('izvestajs.edit', $izvestaj));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_izvestaj(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->get(route('izvestajs.show', $izvestaj));

        $response
            ->assertOk()
            ->assertViewIs('app.izvestajs.show')
            ->assertViewHas('izvestaj');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_izvestaj(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->get(route('izvestajs.edit', $izvestaj));

        $response
            ->assertOk()
            ->assertViewIs('app.izvestajs.edit')
            ->assertViewHas('izvestaj');
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

        $response = $this->put(route('izvestajs.update', $izvestaj), $data);

        $data['izvestaj_id'] = $izvestaj->izvestaj_id;

        $this->assertDatabaseHas('izvestajs', $data);

        $response->assertRedirect(route('izvestajs.edit', $izvestaj));
    }

    /**
     * @test
     */
    public function it_deletes_the_izvestaj(): void
    {
        $izvestaj = Izvestaj::factory()->create();

        $response = $this->delete(route('izvestajs.destroy', $izvestaj));

        $response->assertRedirect(route('izvestajs.index'));

        $this->assertModelMissing($izvestaj);
    }
}
