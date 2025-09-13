<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Transakcija;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TransakcijaController
 */
final class TransakcijaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $transakcijas = Transakcija::factory()->count(3)->create();

        $response = $this->get(route('transakcijas.index'));

        $response->assertOk();
        $response->assertViewIs('transakcija.index');
        $response->assertViewHas('transakcijas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('transakcijas.create'));

        $response->assertOk();
        $response->assertViewIs('transakcija.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransakcijaController::class,
            'store',
            \App\Http\Requests\TransakcijaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('transakcijas.store'));

        $response->assertRedirect(route('transakcijas.index'));
        $response->assertSessionHas('transakcija.id', $transakcija->id);

        $this->assertDatabaseHas(transakcijas, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->get(route('transakcijas.show', $transakcija));

        $response->assertOk();
        $response->assertViewIs('transakcija.show');
        $response->assertViewHas('transakcija');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->get(route('transakcijas.edit', $transakcija));

        $response->assertOk();
        $response->assertViewIs('transakcija.edit');
        $response->assertViewHas('transakcija');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransakcijaController::class,
            'update',
            \App\Http\Requests\TransakcijaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->put(route('transakcijas.update', $transakcija));

        $transakcija->refresh();

        $response->assertRedirect(route('transakcijas.index'));
        $response->assertSessionHas('transakcija.id', $transakcija->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $transakcija = Transakcija::factory()->create();

        $response = $this->delete(route('transakcijas.destroy', $transakcija));

        $response->assertRedirect(route('transakcijas.index'));

        $this->assertModelMissing($transakcija);
    }
}
