<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Roba;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RobaController
 */
final class RobaControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $robas = Roba::factory()->count(3)->create();

        $response = $this->get(route('robas.index'));

        $response->assertOk();
        $response->assertViewIs('roba.index');
        $response->assertViewHas('robas');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('robas.create'));

        $response->assertOk();
        $response->assertViewIs('roba.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RobaController::class,
            'store',
            \App\Http\Requests\RobaStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $response = $this->post(route('robas.store'));

        $response->assertRedirect(route('robas.index'));
        $response->assertSessionHas('roba.id', $roba->id);

        $this->assertDatabaseHas(robas, [ /* ... */ ]);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->get(route('robas.show', $roba));

        $response->assertOk();
        $response->assertViewIs('roba.show');
        $response->assertViewHas('roba');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->get(route('robas.edit', $roba));

        $response->assertOk();
        $response->assertViewIs('roba.edit');
        $response->assertViewHas('roba');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RobaController::class,
            'update',
            \App\Http\Requests\RobaUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->put(route('robas.update', $roba));

        $roba->refresh();

        $response->assertRedirect(route('robas.index'));
        $response->assertSessionHas('roba.id', $roba->id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $roba = Roba::factory()->create();

        $response = $this->delete(route('robas.destroy', $roba));

        $response->assertRedirect(route('robas.index'));

        $this->assertModelMissing($roba);
    }
}
