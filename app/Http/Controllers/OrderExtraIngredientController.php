<?php

namespace App\Http\Controllers;

use App\Models\OrderExtraIngredient;
use App\Models\Order;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;

class OrderExtraIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderExtraIngredients = OrderExtraIngredient::with(['order', 'extraIngredient'])->get();
        return view('order_extra_ingredient.index', compact('orderExtraIngredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
