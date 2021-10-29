<?php

namespace Tests\Unit;

use App\Models\Division;
use Database\Seeders\DivisionSeeder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DivisionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_division()
    {
        $division = new Division();
        $division->name = 'Division 1';
        $division->colaboradores = rand(0,70);
        $division->level = 1;
        $division->save();

        $this->assertCount(1, Division::all());
    }

    public function test_index(){
        $this->seed(DivisionSeeder::class);
        $this->assertInstanceOf(Collection::class, Division::all());
    }

    public function test_show(){
        $this->seed(DivisionSeeder::class);
        $this->assertTrue(Division::exists(1));
    }

    public function test_update_division(){

        $data = [
            'name' => 'Division 1',
            'colaboradores' => rand(0,70)
        ];

        $this->seed(DivisionSeeder::class);
        $division = Division::all()->first();
        $division->name = $data['name'];
        $division->colaboradores = $data['colaboradores'];
        $division->save();

        $this->assertDatabaseHas('divisions', $data);
    }

    public function test_delete_division(){

        $this->seed(DivisionSeeder::class);
        $division = Division::all()->first();
        // obtener subdivisiones de la division
        $subdivisions = $division->subdivisions;

        if (is_null($subdivisions)) {
            $division->delete();
            $this->assertDatabaseMissing('divisions', ['id' => $division->id]);
        } else {
            $this->assertDatabaseHas('divisions', ['id' => $division->id]);
        }

        
    }


}
