<?php

namespace Tests\Feature\Controllers;

use App\Models\Zaposleni;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ZaposleniControllerTest extends TestCase
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
    public function it_displays_index_view_with_zaposlenis(): void
    {
        $zaposlenis = Zaposleni::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('zaposlenis.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.zaposlenis.index')
            ->assertViewHas('zaposlenis');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_zaposleni(): void
    {
        $response = $this->get(route('zaposlenis.create'));

        $response->assertOk()->assertViewIs('app.zaposlenis.create');
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

        $response = $this->post(route('zaposlenis.store'), $data);

        unset($data['password']);
        unset($data['prezime']);

        $this->assertDatabaseHas('zaposlenis', $data);

        $zaposleni = Zaposleni::latest('zaposleni_id')->first();

        $response->assertRedirect(route('zaposlenis.edit', $zaposleni));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->get(route('zaposlenis.show', $zaposleni));

        $response
            ->assertOk()
            ->assertViewIs('app.zaposlenis.show')
            ->assertViewHas('zaposleni');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->get(route('zaposlenis.edit', $zaposleni));

        $response
            ->assertOk()
            ->assertViewIs('app.zaposlenis.edit')
            ->assertViewHas('zaposleni');
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

        $response = $this->put(route('zaposlenis.update', $zaposleni), $data);

        unset($data['password']);
        unset($data['prezime']);

        $data['zaposleni_id'] = $zaposleni->zaposleni_id;

        $this->assertDatabaseHas('zaposlenis', $data);

        $response->assertRedirect(route('zaposlenis.edit', $zaposleni));
    }

    /**
     * @test
     */
    public function it_deletes_the_zaposleni(): void
    {
        $zaposleni = Zaposleni::factory()->create();

        $response = $this->delete(route('zaposlenis.destroy', $zaposleni));

        $response->assertRedirect(route('zaposlenis.index'));

        $this->assertModelMissing($zaposleni);
    }
}
