<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmbassadorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $division = Division::all()->random();
        return [
            'name' => $this->faker->name(),
            'division_id' => $division->id
        ];
    }
}
