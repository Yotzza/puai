<?php

namespace Database\Factories;

use App\Models\Zaposleni;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZaposleniFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zaposleni::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ime' => $this->faker->name(),
            'prezime' => $this->faker->text(255),
            'username' => $this->faker->text(255),
            'password' => \Hash::make('password'),
            'uloga' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
