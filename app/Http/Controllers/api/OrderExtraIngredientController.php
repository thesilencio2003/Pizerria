<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderExtraIngredient;
use App\Models\Order;
use App\Models\ExtraIngredient;

class OrderExtraIngredientController extends Controller
{
    public function index()
    {
        $data = OrderExtraIngredient::with(['order', 'extraIngredient'])->get();

        return response()->json([
            'order_extra_ingredients' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer|min:1',
        ]);

        OrderExtraIngredient::create($request->all());

        return response()->json(['success' => true]);
    }

    public function show(string $id)
    {
        $item = OrderExtraIngredient::with(['order', 'extraIngredient'])->findOrFail($id);
        $orders = Order::orderBy('id')->get();
        $extraIngredients = ExtraIngredient::orderBy('name')->get();

        return response()->json([
            'order_extra_ingredient' => $item,
            'orders' => $orders,
            'extra_ingredients' => $extraIngredients
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'extra_ingredient_id' => 'required|exists:extra_ingredients,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $item = OrderExtraIngredient::findOrFail($id);
        $item->update($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy(string $id)
    {
        $item = OrderExtraIngredient::findOrFail($id);
        $item->delete();

        return response()->json(['success' => true]);
    }
}