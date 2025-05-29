<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\suppliers;
use Illuminate\Http\Request;

class SuppliersApiController extends Controller
{
    public function index()
    {
        $suppliers = suppliers::all();
        return response()->json($suppliers);
    }

    public function show($id)
    {
        $supplier = suppliers::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        return response()->json($supplier);
    }

    public function store(Request $request)
    {
        // Validar datos antes de crear
        $supplier = suppliers::create($request->all());
        return response()->json($supplier, 201);
    }

    public function update(Request $request, $id)
    {
        $supplier = suppliers::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        $supplier->update($request->all());
        return response()->json($supplier);
    }

    public function destroy($id)
    {
        $supplier = suppliers::find($id);
        if (!$supplier) {
            return response()->json(['message' => 'Supplier not found'], 404);
        }
        $supplier->delete();
        return response()->json(['message' => 'Supplier deleted']);
    }
}
