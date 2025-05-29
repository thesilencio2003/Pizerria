<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\raw_materials;
use Illuminate\Http\Request;

class RawApiController extends Controller
{
    public function index()
    {
        return response()->json(raw_materials::all(), 200);
    }

    public function show($id)
    {
        $material = raw_materials::find($id);
        if ($material) {
            return response()->json($material, 200);
        }
        return response()->json(['message' => 'Material not found'], 404);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'quantity' => 'required|numeric',
            'unit' => 'required|string'
        ]);

        $material = raw_materials::create($validated);
        return response()->json($material, 201);
    }

    public function update(Request $request, $id)
    {
        $material = raw_materials::find($id);
        if (!$material) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string',
            'quantity' => 'numeric',
            'unit' => 'string'
        ]);

        $material->update($validated);
        return response()->json($material, 200);
    }

    public function destroy($id)
    {
        $material = raw_materials::find($id);
        if (!$material) {
            return response()->json(['message' => 'Material not found'], 404);
        }

        $material->delete();
        return response()->json(['message' => 'Deleted successfully'], 200);
    }
}
