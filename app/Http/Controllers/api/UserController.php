<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->get();

        return response()->json(['users' => $users], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(['user' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->where('users.id', $id)
            ->first();

        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json(['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return response()->json(['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        $users = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->get();

        return response()->json(['users' => $users, 'success' => true]);
    }
}
