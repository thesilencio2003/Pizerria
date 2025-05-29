<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PizzaSize;

class PizzaSizeController extends Controller
{
    public function index()
    {
        $pizzaSizes = DB::table('pizza_size')
        ->join('pizzas', 'pizza_size.pizza_id', '=', 'pizzas.id')
        ->select('pizza_size.*', 'pizzas.name as pizza_name')
        ->get();

    return response()->json(['pizza_sizes' => $pizzaSizes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        DB::table('pizza_size')->insert([
            'pizza_id' => $request->pizza_id,
            'size' => $request->size,
            'price' => $request->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function show(string $id)
    {
        $pizzaSize = DB::table('pizza_size')
            ->join('pizzas', 'pizza_size.pizza_id', '=', 'pizzas.id')
            ->where('pizza_size.id', $id)
            ->select('pizza_size.*', 'pizzas.name as pizza_name')
            ->first();

        $pizzas = DB::table('pizzas')->orderBy('name')->get();

        return response()->json([
            'pizzaSize' => $pizzaSize,
            'pizzas' => $pizzas
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pizza_id' => 'required|exists:pizzas,id',
            'size' => 'required|in:pequeña,mediana,grande',
            'price' => 'required|numeric|min:0',
        ]);

        DB::table('pizza_size')
            ->where('id', $id)
            ->update([
                'pizza_id' => $request->pizza_id,
                'size' => $request->size,
                'price' => $request->price,
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        DB::table('pizza_size')->where('id', $id)->delete();
        return response()->json(['success' => true]);
    }
}