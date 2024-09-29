<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Delivery;
use App\Models\Order;
use App\Static\PaymentOption;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        request()->validate([
            'collection_id' => 'nullable|exists:collections,id',
        ]);

        $dateInput = request('date');
        $formattedDate = null;

        if ($dateInput) {
            $date = DateTime::createFromFormat('d-m-y', $dateInput);
            if ($date) {
                $formattedDate = $date->format('Y-m-d');
            }
        }

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
                ->when($formattedDate, function ($q) use ($formattedDate) {
                    return $q->whereDate('created_at', $formattedDate);
                })
                ->latest()->paginate(10),
            'old_selected_collection' => +request('collection_id'),
            'date' => $formattedDate
        ]);
    }

    public function create()
    {
        return inertia("Admin/Orders/Create", [
            'collections' => \App\Models\Collection::latest()->get(),
            'payments' => PaymentOption::all(),
            'deliveries' => Delivery::all(),
        ]);
    }

    public function store(OrderRequest $request)
    {
        // Create a new order instance
        $order = new Order();

        // Fill the order data
        $order->name = $request->name;
        $order->color = $request->color;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->payment = $request->payment;
        $order->delivery_id = $request->delivery_id;
        $order->notes = $request->notes;
        $order->collection_id = $request->collection_id;
        $order->amount = $request->amount;

        // Handle file upload if a screenshot is provided
        if ($request->hasFile('screenshot')) {
            $filePath = $request->file('screenshot')->store('screenshots', 'public'); // Store in 'public/screenshots'
            $order->screenshot = $filePath;
        }

        // Save the order to the database
        $order->save();

        // Return a response (could redirect or return JSON)
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }

    public function edit(Order $order)
    {
        return inertia("Admin/Orders/Edit", [
            'collections' => \App\Models\Collection::latest()->get(),
            'payments' => PaymentOption::all(),
            'order' => $order,
            'deliveries' => Delivery::all(),
        ]);
    }
}
