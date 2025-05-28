<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;

class ExtraIngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extra_ingredients = ExtraIngredient::all();
        return json_encode(['extra_ingredients' => $extra_ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $extra_ingredient = ExtraIngredient::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return json_encode(['extra_ingredient' => $extra_ingredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $extra_ingredient = ExtraIngredient::find($id);
        return json_encode(['extra_ingredient' => $extra_ingredient]);

        if (is_null($extra_ingredient)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $extra_ingredient = ExtraIngredient::find($id);
        $extra_ingredient->name = $request->name;
        $extra_ingredient->price = $request->price;
        $extra_ingredient->save();

        return json_encode(['extra_ingredient' => $extra_ingredient]);

        if (is_null($extra_ingredient)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $extra_ingredient = ExtraIngredient::find($id);
        $extra_ingredient->delete();

        $extra_ingredients = ExtraIngredient::all();
        return json_encode(['extra_ingredients' => $extra_ingredients, 'success' => true]);

        if (is_null($extra_ingredient)) {
            return abort(404);
        }
    }
}
