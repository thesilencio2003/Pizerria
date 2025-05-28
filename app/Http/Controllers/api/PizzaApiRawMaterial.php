<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PizzaRawMaterial;
use Illuminate\Http\Request;

class PizzaApiRawMaterial extends Controller
{
    // Mostrar todos los registros
    public function index()
    {
        return PizzaRawMaterial::all();
    }

    // Crear un nuevo registro
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
        ]);

        return PizzaRawMaterial::create($request->all());
    }

    // Mostrar uno solo
    public function show($id)
    {
        return PizzaRawMaterial::findOrFail($id);
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $rawMaterial = PizzaRawMaterial::findOrFail($id);
        $rawMaterial->update($request->all());

        return $rawMaterial;
    }

    // Eliminar
    public function destroy($id)
    {
        $rawMaterial = PizzaRawMaterial::findOrFail($id);
        $rawMaterial->delete();

        return response()->json(['message' => 'Eliminado correctamente']);
    }
}
