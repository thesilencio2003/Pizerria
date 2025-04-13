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
        return view('pizzaz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pizza::create($request->all());
        return redirect()->route('pizzas.index')->with('success', 'Pizza creada correctamente');
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
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
    }
}