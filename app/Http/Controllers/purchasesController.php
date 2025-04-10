<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\purchases;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class purchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = DB::table('purchases')->get();
        return view('purchases.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = DB::table('suppliers')->get();
        $rawMaterials = DB::table('raw_materials')->get();
        return view('purchases.new', compact('suppliers', 'rawMaterials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        try {
            DB::table('purchases')->insert([
                'supplier_id' => $request->supplier_id,
                'raw_material_id' => $request->raw_material_id,
                'quantity' => $request->quantity,
                'purchase_price' => $request->purchase_price,
                'purchase_date' => $request->purchase_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('purchases.index')->with('success', 'Compra creada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Error al crear la compra: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = DB::table('purchases')->where('id', $id)->first();

        if (!$purchase) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Compra no encontrada.']);
        }

        $purchase->purchase_date = Carbon::parse($purchase->purchase_date);


        $suppliers = DB::table('suppliers')->get();
        $rawMaterials = DB::table('raw_materials')->get();
        return view('purchases.edit', compact('purchase', 'suppliers', 'rawMaterials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        $purchase = DB::table('purchases')->where('id', $id)->first();

        if (!$purchase) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Compra no encontrada.']);
        }

        try {
            // Actualizar la compra
            DB::table('purchases')->where('id', $id)->update([
                'supplier_id' => $request->supplier_id,
                'raw_material_id' => $request->raw_material_id,
                'quantity' => $request->quantity,
                'purchase_price' => $request->purchase_price,
                'purchase_date' => $request->purchase_date,
                'updated_at' => now(),
            ]);

            return redirect()->route('purchases.index')->with('success', 'Compra actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Error al actualizar la compra: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = DB::table('purchases')->where('id', $id)->first();

        if (!$purchase) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Compra no encontrada.']);
        }

        try {
            DB::table('purchases')->where('id', $id)->delete();

            return redirect()->route('purchases.index')->with(' success', 'Compra eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('purchases.index')->withErrors(['error' => 'Error al eliminar la compra: ' . $e->getMessage()]);
        }
    }
}
