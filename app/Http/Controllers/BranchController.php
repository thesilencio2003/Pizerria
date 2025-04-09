<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    // Muestra todas las sucursales
    public function index()
    {
        $branches = Branch::all();
        return response()->json($branches);
    }

    // Muestra el formulario para crear una nueva sucursal (solo para web, puedes omitirlo en API)
    public function create()
    {
        // return view('branches.create'); // Solo si usas Blade
    }

    // Guarda una nueva sucursal
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'address'  => 'required|string',
            'phone'    => 'nullable|string|max:20',
        ]);

        $branch = Branch::create($request->all());

        return response()->json([
            'message' => 'Sucursal creada exitosamente',
            'data' => $branch,
        ], 201);
    }

    // Muestra una sola sucursal
    public function show(Branch $branch)
    {
        return response()->json($branch);
    }

    // Muestra el formulario para editar una sucursal (solo para web)
    public function edit(Branch $branch)
    {
        // return view('branches.edit', compact('branch')); // Solo si usas Blade
    }

    // Actualiza una sucursal
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'address'  => 'required|string',
            'phone'    => 'nullable|string|max:20',
        ]);

        $branch->update($request->all());

        return response()->json([
            'message' => 'Sucursal actualizada correctamente',
            'data' => $branch,
        ]);
    }

    // Elimina una sucursal
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return response()->json([
            'message' => 'Sucursal eliminada correctamente',
        ]);
    }
}
