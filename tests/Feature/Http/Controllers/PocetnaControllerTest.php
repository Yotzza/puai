<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Pocetna;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PocetnaController
 */
final class PocetnaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $pocetnas = Pocetna::factory()->count(3)->create();

        $response = $this->get(route('pocetnas.index'));

        $response->assertOk();
        $response->assertViewIs('pocetna.index');
        $response->assertViewHas('pocetnas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('pocetnas.create'));

        $response->assertOk();
        $response->assertViewIs('pocetna.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PocetnaController::class,
            'store',
            \App\Http\Requests\PocetnaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('pocetnas.store'));

        $response->assertRedirect(route('pocetnas.index'));
        $response->assertSessionHas('pocetna.id', $pocetna->id);

        $this->assertDatabaseHas(pocetnas, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $pocetna = Pocetna::factory()->create();

        $response = $this->get(route('pocetnas.show', $pocetna));

        $response->assertOk();
        $response->assertViewIs('pocetna.show');
        $response->assertViewHas('pocetna');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $pocetna = Pocetna::factory()->create();

        $response = $this->get(route('pocetnas.edit', $pocetna));

        $response->assertOk();
        $response->assertViewIs('pocetna.edit');
        $response->assertViewHas('pocetna');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PocetnaController::class,
            'update',
            \App\Http\Requests\PocetnaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $pocetna = Pocetna::factory()->create();

        $response = $this->put(route('pocetnas.update', $pocetna));

        $pocetna->refresh();

        $response->assertRedirect(route('pocetnas.index'));
        $response->assertSessionHas('pocetna.id', $pocetna->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $pocetna = Pocetna::factory()->create();

        $response = $this->delete(route('pocetnas.destroy', $pocetna));

        $response->assertRedirect(route('pocetnas.index'));

        $this->assertModelMissing($pocetna);
    }
}
