<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = DB::table('ingredients')->get();
        return json_encode(['ingredients' => $ingredients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('ingredients')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $ingredient = DB::table('ingredients')
            ->where('name', $request->name)
            ->orderByDesc('id')
            ->first();

        return json_encode(['ingredient' => $ingredient]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ingredient = DB::table('ingredients')->find($id);
        return json_encode(['ingredient' => $ingredient]);

        if (is_null($ingredient)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          DB::table('ingredients')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);

        $ingredient = DB::table('ingredients')->find($id);
        return json_encode(['ingredient' => $ingredient]);

        if (is_null($ingredient)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('ingredients')->where('id', $id)->delete();

        $ingredients = DB::table('ingredients')->get();
        return json_encode(['ingredients' => $ingredients, 'success' => true]);

        if (is_null($ingredient)) {
            return abort(404);
        }
    }
}
