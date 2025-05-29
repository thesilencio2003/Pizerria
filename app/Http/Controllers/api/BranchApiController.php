<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchApiController extends Controller
{
    public function index()
    {
        return response()->json(Branch::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string',
        ]);

        $branch = Branch::create($validated);
        return response()->json($branch, 201);
    }

    public function show($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }
        return response()->json($branch, 200);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'location' => 'nullable|string',
        ]);

        $branch->update($validated);
        return response()->json($branch, 200);
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);
        if (!$branch) {
            return response()->json(['message' => 'Sucursal no encontrada'], 404);
        }

        $branch->delete();
        return response()->json(['message' => 'Sucursal eliminada'], 200);
    }
}
