<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
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

        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $roles = [
            (object) ['role' => 'cliente'],
            (object) ['role' => 'cajero'],
            (object)['role' => 'admin'],
            (object)['role' => 'vendedor'],
            
        ];

        $clients = DB::table('clients')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->select('clients.id', 'users.name')
        ->get();
        $employees = DB::table('employees')
        ->join('users', 'employees.user_id', '=', 'users.id')
        ->select('employees.id', 'users.name')
        ->get();

        return view('user.new', [
            'roles' => $roles,
            'clients' => $clients,
            'employees' => $employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,cliente,vendedor,cajero',
            'client_id' => 'nullable|exists:clients,id',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->client_id = $request->client_id;
        $user->employee_id = $request->employee_id;
        $user->save();

        $users = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->get();

        return view('user.index', ['users' => $users]);
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
        $user = User::find($id);

    $roles = [
        (object) ['role' => 'admin'],
        (object) ['role' => 'cliente'],
        (object) ['role' => 'vendedor'],
        (object) ['role' => 'cajero'],
    ];

    $clients = DB::table('clients')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->select('clients.id', 'users.name')
        ->get();

    $employees = DB::table('employees')
        ->join('users', 'employees.user_id', '=', 'users.id')
        ->select('employees.id', 'users.name')
        ->get();

    return view('user.edit', [
        'user' => $user,
        'roles' => $roles,
        'clients' => $clients,
        'employees' => $employees,
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,cliente,vendedor,cajero',
            'client_id' => 'nullable|exists:clients,id',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->client_id = $request->client_id;
        $user->employee_id = $request->employee_id;
        $user->save();

        $users = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->get();

        return view('user.index', ['users' => $users]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('employees')->where('user_id', $id)->delete();
        DB::table('clients')->where('user_id', $id)->delete();

        $user = User::find($id);
        $user->delete();

        $users = User::leftJoin('employees', 'users.id', '=', 'employees.user_id')
            ->leftJoin('clients', 'users.id', '=', 'clients.user_id')
            ->select('users.*', 'employees.id as employee_relation_id', 'clients.id as client_relation_id')
            ->get();

        return view('user.index', ['users' => $users]);
    }
}
