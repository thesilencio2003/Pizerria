<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
    {
        $employees = DB::table('employees')
                     ->leftJoin('users', 'employees.user_id', '=', 'users.id')
                     ->select('employees.*', 'users.name as user_name')
                     ->get();

        return response()->json(['employees' => $employees]);
    }

    /**
     * Almacena un recurso recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string|max:20|unique:employees,identification_number',
            'salary' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'hire_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $employee = new employees();
            $employee->user_id = $request->user_id;
            $employee->position = $request->position;
            $employee->identification_number = $request->identification_number;
            $employee->salary = $request->salary;
            $employee->hire_date = $request->hire_date;
            $employee->save();

            return response()->json(['employee' => $employee, 'message' => 'Empleado creado exitosamente'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor al crear el empleado. Por favor, intente más tarde.'], 500);
        }
    }

    /**
     * Muestra el recurso especificado.
     */
    public function show(string $id)
    {
        $employee = employees::find($id);

        if (is_null($employee)) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }

        return response()->json(['employee' => $employee]);
    }

    /**
     * Actualiza el recurso especificado en la base de datos.
     */
    public function update(Request $request, string $id)
    {
        $employee = employees::find($id);

        if (is_null($employee)) {
            return response()->json(['message' => 'Empleado no encontrado para actualizar'], 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string|max:20|unique:employees,identification_number,' . $employee->id,
            'salary' => 'required|numeric|min:0|regex:/^\d+(\.\d{1,2})?$/',
            'hire_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $employee->user_id = $request->user_id;
            $employee->position = $request->position;
            $employee->identification_number = $request->identification_number;
            $employee->salary = $request->salary;
            $employee->hire_date = $request->hire_date;
            $employee->save();

            return response()->json(['employee' => $employee, 'message' => 'Empleado actualizado exitosamente']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor al actualizar el empleado. Por favor, intente más tarde.'], 500);
        }
    }

    /**
     * Elimina el recurso especificado de la base de datos.
     */
    public function destroy(string $id)
    {
        $employee = employees::find($id);

        if (is_null($employee)) {
            return response()->json(['message' => 'Empleado no encontrado para eliminar'], 404);
        }

        try {
            $employee->delete();

            $employees = DB::table('employees')
                         ->leftJoin('users', 'employees.user_id', '=', 'users.id')
                         ->select('employees.*', 'users.name as user_name')
                         ->get();

            return response()->json(['employees' => $employees, 'success' => true, 'message' => 'Empleado eliminado exitosamente']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor al eliminar el empleado. Por favor, intente más tarde.'], 500);
        }
    }
}
