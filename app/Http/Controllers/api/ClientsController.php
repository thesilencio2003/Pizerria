<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select('clients.*', 'users.name as user_name')
            ->latest('clients.created_at')
            ->get();

        return json_encode(['clients' => $clients]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $client = new Client();
        $client->user_id = $request->user_id;
        $client->save();

        return json_encode(['client' => $client]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::find($id);
        $user = DB::table('users')->find($client->user_id);
        return json_encode(['client' => $client, 'user' => $user]);

        if (is_null($client)) {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $client = Client::find($id);
        $client->user_id = $request->user_id;
        $client->save();

        return json_encode(['client' => $client]);

        if (is_null($client)) {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::find($id);
        $client->delete();

        $clients = DB::table('clients')
            ->join('users', 'clients.user_id', '=', 'users.id')
            ->select('clients.*', 'users.name as user_name')
            ->latest('clients.created_at')
            ->get();

        return json_encode(['clients' => $clients, 'success' => true]);

        if (is_null($client)) {
            return abort(404);
        }
    }
}
