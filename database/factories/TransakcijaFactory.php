<?php

namespace Database\Factories;

use App\Models\Transakcija;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransakcijaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transakcija::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kolicina' => $this->faker->randomNumber(0),
            'datum' => $this->faker->date(),
            'tip' => $this->faker->text(255),
            'zaposleni_id' => \App\Models\Zaposleni::factory(),
            'roba_id' => \App\Models\Roba::factory(),
        ];
    }
}
