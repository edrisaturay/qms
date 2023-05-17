<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Counter;

class CounterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Counter::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->city;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'status' => true,
        ];
    }
}
