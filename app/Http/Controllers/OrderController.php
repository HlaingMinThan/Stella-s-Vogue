<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        request()->validate([
            'collection_id' => 'nullable|exists:collections,id',
        ]);
        return inertia("Admin/Orders/Index", [
            'collections' => \App\Models\Collection::latest()->get(),
            'orders' => \App\Models\Order::with('collection', 'delivery')
                ->when(request('collection_id'), function ($q) {
                    return $q->where('collection_id', request('collection_id'));
                })
                ->where(function ($q) {
                    $q
                        ->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('phone', 'like', '%' . request('search') . '%')
                        ->orWhere('address', 'like', '%' . request('search') . '%')
                        ->orWhere('color', 'like', '%' . request('search') . '%');
                })
                ->latest()->paginate(10),
            'old_selected_collection' => +request('collection_id')
        ]);
    }

    public function create()
    {
        return inertia("Admin/Orders/Create", [
            'collections' => \App\Models\Collection::latest()->get(),
        ]);
    }
    public function edit(Order $order)
    {
        return inertia("Admin/Orders/Edit", [
            'collections' => \App\Models\Collection::latest()->get(),
            'order' => $order
        ]);
    }
}
