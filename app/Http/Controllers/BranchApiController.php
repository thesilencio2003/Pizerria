<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class BranchApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * Muestra una lista de todas las sucursales.
     */
    public function index()
    {
        $branches = Branch::all();
        return response()->json($branches);
    }

    /**
     * Store a newly created resource in storage.
     * Almacena una nueva sucursal en la base de datos.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                // Define aquí las reglas de validación para los campos de tu modelo Branch.
                // Por ejemplo, si tu tabla 'branches' tiene campos 'name' y 'address':
                'name' => 'required|string|max:255|unique:branches,name',
                'address' => 'required|string|max:255',
                // Agrega más campos según tu esquema de base de datos
                // 'phone' => 'nullable|string|max:20',
            ]);

            $branch = Branch::create($validatedData);
            return response()->json($branch, 201); // 201 Created
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear la sucursal',
                'error' => $e->getMessage()
            ], 500); // 500 Internal Server Error
        }
    }

    /**
     * Display the specified resource.
     * Muestra una sucursal específica.
     */
    public function show(string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404); // 404 Not Found
        }

        return response()->json($branch);
    }

    /**
     * Update the specified resource in storage.
     * Actualiza una sucursal existente en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        try {
            $validatedData = $request->validate([
                // Define aquí las reglas de validación para la actualización.
                // Usa 'sometimes' si el campo no es obligatorio en la actualización.
                'name' => 'sometimes|string|max:255|unique:branches,name,' . $id, // Ignora el nombre actual de la sucursal
                'address' => 'sometimes|string|max:255',
                // 'phone' => 'nullable|string|max:20',
            ]);

            $branch->update($validatedData);
            return response()->json($branch);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar la sucursal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Elimina una sucursal de la base de datos.
     */
    public function destroy(string $id)
    {
        $branch = Branch::find($id);

        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        try {
            $branch->delete();
            return response()->json(['message' => 'Sucursal eliminada exitosamente'], 200); // 200 OK
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar la sucursal',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}