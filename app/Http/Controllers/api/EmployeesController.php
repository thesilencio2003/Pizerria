<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\employees;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $employees = DB::table('employees')->get();
        return json_encode(['employees' => $employees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employee = new employees();
        $employee->user_id = $request->user_id;
        $employee->save();

        return json_encode(['employee' => $employee]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = employees::find($id);
        return json_encode(['employee' => $employee]);

        if (is_null($employee)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $employee = employees::find($id);
        $employee->user_id = $request->user_id ?? $employee->user_id;
        $employee->save();

        return json_encode(['employee' => $employee]);

        if (is_null($employee)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = employees::find($id);
        $employee->delete();

        $employees = DB::table('employees')->get();
        return json_encode(['employees' => $employees, 'success' => true]);

        if (is_null($employee)) {
            return abort(404);
        }
    }
}
