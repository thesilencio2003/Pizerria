<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchases;

class PurchasesApiController extends Controller
{
    // Listar todas las compras
    public function index()
    {
        $purchases = Purchases::all();
        return response()->json($purchases);
    }

    // Mostrar una compra específica
    public function show($id)
    {
        $purchase = Purchases::find($id);
        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }
        return response()->json($purchase);
    }

    // Crear una compra
    public function store(Request $request)
    {
        // Aquí debes validar los campos que tu tabla tiene (ajustar según tu estructura)
        $request->validate([
            // Ejemplo:
            //'field_name' => 'required',
        ]);

        $purchase = Purchases::create($request->all());

        return response()->json($purchase, 201);
    }

    // Actualizar una compra
    public function update(Request $request, $id)
    {
        $purchase = Purchases::find($id);
        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }

        // Validar si es necesario
        $request->validate([
            // 'field_name' => 'sometimes|required',
        ]);

        $purchase->update($request->all());

        return response()->json($purchase);
    }

    // Eliminar una compra
    public function destroy($id)
    {
        $purchase = Purchases::find($id);
        if (!$purchase) {
            return response()->json(['message' => 'Purchase not found'], 404);
        }
        $purchase->delete();

        return response()->json(['message' => 'Purchase deleted']);
    }
}
