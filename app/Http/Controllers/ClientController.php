<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ClientController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:view-clients', only: ['index', 'show']),
            new Middleware('permission:create-clients', only: ['create', 'store']),
            new Middleware('permission:edit-clients', only: ['edit', 'update']),
            new Middleware('permission:delete-clients', only: ['destroy']),
        ];
    }

    public function index()
    {
        $clients = Client::paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        Client::create($request->validated());
        return redirect()->route('clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());
        return redirect()->route('clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully.');
    }
}
