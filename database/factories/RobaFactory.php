<?php

namespace Database\Factories;

use App\Models\Roba;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RobaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Roba::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => $this->faker->text(255),
            'sifra' => $this->faker->text(255),
            'opis' => $this->faker->text(255),
            'kolicina' => $this->faker->randomNumber(0),
            'lokacija' => $this->faker->text(255),
        ];
    }
}
