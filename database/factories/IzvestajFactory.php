<?php

namespace Database\Factories;

use App\Models\Izvestaj;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class IzvestajFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Izvestaj::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'opis' => $this->faker->text(255),
            'datum' => $this->faker->date(),
            'tip' => $this->faker->text(255),
            'zaposleni_id' => \App\Models\Zaposleni::factory(),
        ];
    }
}
