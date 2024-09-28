<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function  index()
    {
        return inertia("Admin/Orders/Index", [
            'orders' => \App\Models\Order::latest()->get()
        ]);
    }
}
