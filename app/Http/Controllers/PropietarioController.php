<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;

class PropietarioController extends Controller
{
    public function store(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telefono' => 'required|numeric',
            'dui' => 'required',
            'genero' => 'required',
        ]);

        $propietario = new Propietario();
        $propietario->nombre = $request->nombre;
        $propietario->apellido = $request->apellido;
        $propietario->telefono = $request->telefono;
        $propietario->dui = $request->dui;
        $propietario->genero = $request->genero;
        $propietario->mascota_id = $id;
        $propietario->save();

        return redirect()->route('mascotas.index')->with('success', 'Propietario asignado correctamente.');
    }

}
