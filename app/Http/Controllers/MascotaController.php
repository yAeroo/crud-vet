<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mascota;
use App\Models\GeneroCatalog;
use App\Models\EspecieCatalog;

class MascotaController extends Controller
{
    public function index()
    {
        $mascotasList = Mascota::with('propietario', 'especie', 'genero')->get();
        return view('mascota.index', compact('mascotasList'));
    }

    public function create()
    {
        $especieList = EspecieCatalog::all();
        $generoList = GeneroCatalog::all();
        return view('mascota.create', compact('especieList', 'generoList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'especie_id' => 'required|numeric',
            'genero' => 'required|numeric',
            'fecha_nacimiento' => 'required'
        ]);

        $mascota = new Mascota();
        $mascota->nombre = $request->nombre;
        $mascota->especie_id = $request->especie_id;
        $mascota->genero = $request->genero;
        $mascota->fecha_nacimiento = $request->fecha_nacimiento;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success', "Mascota Creada Exitosamente");
    }

    public function show(string $id)
    {
        $mascota = Mascota::with('propietario', 'especie', 'genero')->findOrFail($id);
        return response()->json($mascota);
    }

    public function edit(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $especieList = EspecieCatalog::all();
        $generoList = GeneroCatalog::all();
        return view('mascota.edit', compact('mascota', 'especieList', 'generoList'));
    }

    public function assign(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $generoList = GeneroCatalog::all();
        return view('mascota.assign', compact('mascota', 'generoList'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'especie_id' => 'required|numeric',
            'genero' => 'required|numeric',
            'fecha_nacimiento' => 'required'
        ]);

        $mascota = Mascota::findOrFail($id);
        $mascota->nombre = $request->nombre;
        $mascota->especie_id = $request->especie_id;
        $mascota->genero = $request->genero;
        $mascota->fecha_nacimiento = $request->fecha_nacimiento;
        $mascota->save();

        return redirect()->route('mascotas.index')->with('success', "Mascota Actualizada Exitosamente");
    }

    public function destroy(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();
        return redirect()->route('mascotas.index')->with('success', "Mascota Eliminada Exitosamente");
    }
}
