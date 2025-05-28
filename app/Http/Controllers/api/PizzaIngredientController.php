<?php

namespace App\Http\Controllers\api;
use App\Models\PizzaIngredient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class PizzaIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzaIngredients = DB::table('pizza_ingredient')
            ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select(
                'pizza_ingredient.*',
                'pizzas.name as pizza_nombre',
                'ingredients.name as ingredient_nombre'
            )
            ->get();

        return json_encode(['pizza_ingredients' => $pizzaIngredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('pizza_ingredient')->insert([
            'pizza_id' => $request->pizza_id,
            'ingredient_id' => $request->ingredient_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pizzaIngredient = DB::table('pizza_ingredient')
            ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select(
                'pizza_ingredient.*',
                'pizzas.name as pizza_nombre',
                'ingredients.name as ingredient_nombre'
            )
            ->orderByDesc('pizza_ingredient.id')
            ->first();

        return json_encode(['pizza_ingredient' => $pizzaIngredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pizzaIngredient = DB::table('pizza_ingredient')
            ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select(
                'pizza_ingredient.*',
                'pizzas.name as pizza_nombre',
                'ingredients.name as ingredient_nombre'
            )
            ->where('pizza_ingredient.id', $id)
            ->first();

        return json_encode(['pizza_ingredient' => $pizzaIngredient]);

        if (is_null($pizzaIngredient)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::table('pizza_ingredient')
            ->where('id', $id)
            ->update([
                'pizza_id' => $request->pizza_id,
                'ingredient_id' => $request->ingredient_id,
                'updated_at' => now(),
            ]);

        $pizzaIngredient = DB::table('pizza_ingredient')
            ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select(
                'pizza_ingredient.*',
                'pizzas.name as pizza_nombre',
                'ingredients.name as ingredient_nombre'
            )
            ->where('pizza_ingredient.id', $id)
            ->first();

        return json_encode(['pizza_ingredient' => $pizzaIngredient]);

        if (is_null($pizzaIngredient)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pizza_ingredient')->where('id', $id)->delete();

        $pizzaIngredients = DB::table('pizza_ingredient')
            ->join('pizzas', 'pizza_ingredient.pizza_id', '=', 'pizzas.id')
            ->join('ingredients', 'pizza_ingredient.ingredient_id', '=', 'ingredients.id')
            ->select(
                'pizza_ingredient.*',
                'pizzas.name as pizza_nombre',
                'ingredients.name as ingredient_nombre'
            )
            ->get();

        return json_encode(['pizza_ingredients' => $pizzaIngredients, 'success' => true]);

        if (is_null($pizzaIngredient)) {
            return abort(404);
        }
    }
}
