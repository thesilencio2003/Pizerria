<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pizzasController extends Controller
{
    public function index()
    {
        $pizzas = pizza::all();

        return view('pizzas.index', [
            'pizzas' => $pizzas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pizzas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pizzas = pizza::find($id);
        $pizzas->name = $request->input('name');
        $pizzas->save();

        return view('pizzas.index', [
            'pizzas' => pizza::all()
        ]);
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
        $pizzas = pizza::find($id);

        return view('pizzas.edit', [
            'pizzas' => $pizzas
        ]);  

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pizzas = pizza::find($id);
        $pizzas->name = $request->input('name');
        $pizzas->save();

        return view('pizzas.index', [
            'pizzas' => pizza::all()
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pizzas = pizza::find($id);
        $pizzas->delete();

        return view('pizzas.index', [
            'pizzas' => pizza::all()
        ]);

    }
}