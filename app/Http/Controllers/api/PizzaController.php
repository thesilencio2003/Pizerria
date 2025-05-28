<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = pizza::all();
        return json_encode(['pizzas' => $pizzas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->save();

        return json_encode(['pizza' => $pizza]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pizza = Pizza::find($id);
        return json_encode(['pizza' => $pizza]);

        if (is_null($pizza)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizza = Pizza::find($id);
        $pizza->name = $request->name;
        $pizza->save();

        return json_encode(['pizza' => $pizza]);

        
        if (is_null($pizza)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
             $pizza = Pizza::find($id);
        $pizza->delete();

        $pizzas = Pizza::all();
        return json_encode(['pizzas' => $pizzas, 'success' => true]);

        if (is_null($pizza)) {
            return abort(404);
        }
    }
}
