<?php

namespace Database\Factories;

use App\Models\Division;
use Illuminate\Database\Eloquent\Factories\Factory;

class DivisionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $division = null;
        $level = 1;// Level inicial si es una división matriz.

        // Arreglo de nombres de divisiones para generar
        $divisions_name = ['Dirección General','Producto','Operaciones','Strategy','CEO'];

        $division_collection = Division::all();

        // Validamos si existe una division matriz para crear una subdivision y 
        // también generamos un numero entre 1 y 0 para ver si se crea o no una subdivision
        // Con esto se crearán divisiones que tenga o no una división matriz.
        if ($division_collection->count() > 0 and rand(0, 1) == 1) {

            $division = $division_collection->random();
            // El level será uno más que la división matriz.
            $level = $division->level + 1;
        }

        return [
            //Obtenemos el nombre de una división aleatoriamente.
            'name' => $divisions_name[rand(0, count($divisions_name)-1)],
            'division_id' => $division,
            'colaboradores' => $this->faker->numberBetween(1, 10),
            'level' => $level
        ];
    }
}
