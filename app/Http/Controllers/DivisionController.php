<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionFormRequest;
use App\Models\Division;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = Division::all();

        foreach ($divisions as $index => $division) {
            $divisions[$index]->subdivisions = $division->subdivisions;
            $divisions[$index]->division_parent = $division->divisionParent;

            $divisions[$index]->division_parent_name = 'No hay división superior';
            if (!is_null($division->divisionParent)) {
                $divisions[$index]->division_parent_name = $division->divisionParent->name;
            }
        }

        return $divisions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DivisionFormRequest $request)
    {
        $data = [];

        $request= $request->all();
        $request['level'] = 1;// Level por defecto

        // Si la nueva division es hija de otra, actualizaremos el level
        if (isset($request['division_id']) and !is_null($request['division_id'])) {
            $division = Division::find($request['division_id']);
            $request['level'] = $division->level + 1;
        }

        $division = Division::create($request);
        $data = $division;

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // obtener una division y sus subdivisiones
        $division = Division::find($id);
        if (!$division) {
            return [];
        }

        $subdivisions = $division->subdivisions;

        if ($subdivisions->count() > 0) {
            $division->subdivisions = $subdivisions;
        }

        return $division;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DivisionFormRequest $request, $id)
    {
        $data = [];
        $request = $request->all();
        $request['level'] = 1;// Level por defecto

        $division_to_update = Division::find($id);
        
        // Si la division a actualizar es hija de otra, actualizaremos el level
        if (isset($request['division_id']) and !is_null($request['division_id'])) {
            $division = Division::find($request['division_id']);
            $request['level'] = $division->level + 1;
        }

        $division_to_update->update($request);
        $data = $division_to_update;

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [];

        if (is_null(Division::find($id))) {
            $data['error'] = 'División no existe';
            return $data;
        }

        try {
            $division_to_delete = Division::find($id);
            $division_to_delete->delete();
        } catch (\Throwable $th) {
            $data['error'] = 'No se puede eliminar la division';
        }

        return response()->json(null);
    }
}
