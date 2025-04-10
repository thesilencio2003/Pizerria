<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employees;
use Illuminate\Support\Facades\DB;

class employeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = DB::table('employees')->get();
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = DB::table('users')->get();
        return view('employee.new', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string|max:20',
            'salary' => 'required|numeric|min:0',
            'hire_date' => 'required|date',
        ]);

        try {
            DB::table('employees')->insert([
                'user_id' => $request->user_id,
                'position' => $request->position,
                'identification_number' => $request->identification_number,
                'salary' => $request->salary,
                'hire_date' => $request->hire_date,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('employees.index')->with('success', 'Empleado creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->withErrors(['error' => 'Error al crear el empleado: ' . $e->getMessage()]);
        }
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
