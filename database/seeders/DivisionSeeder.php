<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definimos un for con la finalidad de que pueda crear subdivisiones
        // Ya que si creacemos 10 registros instantaneos, la instancia no encontrará
        // los registros previos mientras va creando cada uno.
        for ($i = 1; $i <= 10; $i++) {
            Division::factory()->count(1)->create();
        }
    }
}
