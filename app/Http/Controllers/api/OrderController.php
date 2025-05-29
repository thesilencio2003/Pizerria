<?php

namespace App\Http\Controllers\api;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->get();
        return json_encode(['orders' => $orders]);
    }

    public function store(Request $request)
    {
        $order = new Order();
        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->pizza_size_id = $request->pizza_size_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->delivery_person_id = $request->delivery_person_id;
        $order->save();

        return json_encode(['order' => $order, 'message' => 'Pedido creado correctamente']);
    }

    public function show($id)
    {
        $order = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->find($id);
        return json_encode(['order' => $order]);
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->client_id = $request->client_id;
        $order->branch_id = $request->branch_id;
        $order->pizza_size_id = $request->pizza_size_id;
        $order->total_price = $request->total_price;
        $order->status = $request->status;
        $order->delivery_type = $request->delivery_type;
        $order->delivery_person_id = $request->delivery_person_id;
        $order->save();

        return json_encode(['order' => $order, 'message' => 'Pedido editado correctamente']);
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        $orders = Order::with(['client.user', 'branch', 'deliveryPerson.user'])->get();
        return json_encode(['orders' => $orders, 'success' => true, 'message' => 'Pedido eliminado correctamente']);
    }
}