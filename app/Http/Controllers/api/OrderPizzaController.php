<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\order_pizza;

class OrderPizzaController extends Controller
{
    public function index()
    {
        $orderPizzas = DB::table('order_pizza')
            ->join('orders', 'order_pizza.order_id', '=', 'orders.id')
            ->join('pizza_size', 'order_pizza.pizza_size_id', '=', 'pizza_size.id')
            ->select(
                'order_pizza.*',
                'orders.id as order_id',
                'orders.created_at as order_created_at',
                'pizza_size.size as pizza_size_name',
                'pizza_size.price as pizza_size_price'
            )
            ->get();

        return response()->json(['orderPizzas' => $orderPizzas]);
    }

    public function store(Request $request)
    {
        $item = new order_pizza();
        $item->order_id = $request->order_id;
        $item->pizza_size_id = $request->pizza_size_id;
        $item->quantity = $request->quantity;
        $item->save();

        return response()->json([
            'orderPizza' => $item,
            'success' => true,
            'message' => 'Pizza agregada a la orden correctamente'
        ]);
    }

    public function show($id)
    {
        $item = order_pizza::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'No encontrado'], 404);
        }

        $orders = DB::table('orders')->orderBy('id')->get();
        $pizzaSizes = DB::table('pizza_size')->orderBy('id')->get();

        return response()->json([
            'orderPizza' => $item,
            'orders' => $orders,
            'pizzaSizes' => $pizzaSizes
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = order_pizza::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'No encontrado'], 404);
        }

        $item->order_id = $request->order_id;
        $item->pizza_size_id = $request->pizza_size_id;
        $item->quantity = $request->quantity;
        $item->save();

        return response()->json([
            'orderPizza' => $item,
            'success' => true,
            'message' => 'Pizza en la orden actualizada correctamente'
        ]);
    }

    public function destroy($id)
    {
        $item = order_pizza::find($id);
        if (!$item) {
            return response()->json(['success' => false, 'message' => 'Pizza no encontrada'], 404);
        }

        try {
            $item->delete();

            $orderPizzas = DB::table('order_pizza')
                ->join('orders', 'order_pizza.order_id', '=', 'orders.id')
                ->join('pizza_size', 'order_pizza.pizza_size_id', '=', 'pizza_size.id')
                ->select(
                    'order_pizza.*',
                    'orders.id as order_id',
                    'pizza_size.size as pizza_size_name',
                    'pizza_size.price as pizza_size_price'
                )
                ->get();

            return response()->json([
                'orderPizzas' => $orderPizzas,
                'success' => true,
                'message' => 'Pizza en la orden eliminada correctamente'
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar: ' . $e->getMessage()], 500);
        }
    }
}