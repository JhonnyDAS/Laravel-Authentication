<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'clients' => Client::count(),
            'products' => Product::count(),
            'recent_users' => User::latest()->take(5)->get(),
            'recent_clients' => Client::latest()->take(5)->get(),
            'recent_products' => Product::latest()->take(5)->get(),
        ];

        return view('dashboard', compact('stats'));
    }
}
