<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetail;
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

        $collection = \App\Models\Collection::find(request('collection_id'));
        return inertia("Admin/Orders/Index", [
            'collections' => \App\Models\Collection::latest()->get(),
            'orders' => \App\Models\Order::with('collection', 'delivery', 'orderDetails') // Eager load orderDetails
                ->when(request('collection_id'), function ($q) {
                    return $q->where('collection_id', request('collection_id'));
                })
                ->where(function ($q) {
                    $q->where('name', 'like', '%' . request('search') . '%')
                        ->orWhere('phone', 'like', '%' . request('search') . '%')
                        ->orWhere('address', 'like', '%' . request('search') . '%')
                        // Join with order_details table for color filtering
                        ->orWhereHas('orderDetails', function ($query) {
                            $query->where('color', 'like', '%' . request('search') . '%');
                        });
                })
                ->when(request('date'), function ($q) {
                    return $q->whereDate('created_at', request('date'));
                })
                ->latest()
                ->paginate(10)
                ->through(fn($order) => [
                    ...$order->toArray(),
                    'amount' => $order->orderDetails->sum('amount'),
                    'editable' => auth()->user()->isAdmin(),
                ]),
            'old_selected_collection' => $collection?->id,
            'collection' => $collection,
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
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->payment = $request->payment;
        $order->delivery_id = $request->delivery_id;
        $order->deli_amount = $request->deli_amount;
        if ($request->created_at) {
            $order->created_at = $request->created_at;
        }

        // Handle file upload if a screenshot is provided
        if ($request->hasFile('screenshot')) {
            $filePath = $request->file('screenshot')->store('screenshots', 'public'); // Store in 'public/screenshots'
            $order->screenshot = $filePath;
        }

        // Save the order to the database
        $order->save();

        foreach ($request->validated()['collections'] as $collection) {
            OrderDetail::create([
                'order_id' => $order->id,
                'collection_id' => $collection['collection_id'],
                'color' => $collection['color'],
                'size' => $collection['size'],
                'amount' => $collection['amount']
            ]);
        }

        // Return a response (could redirect or return JSON)
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }

    public function edit(Order $order)
    {
        $orderDetails = Order::where('id', $order->id)->with('orderDetails')->first();
        return inertia("Admin/Orders/Edit", [
            'collections' => \App\Models\Collection::latest()->get(),
            'payments' => PaymentOption::all(),
            'order' => $orderDetails,
            'deliveries' => Delivery::all(),
        ]);
    }

    public function update(OrderRequest $request, Order $order)
    {
        // Fill the order data
        $order->name = $request->name;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->payment = $request->payment;
        $order->delivery_id = $request->delivery_id;
        $order->deli_amount = $request->deli_amount;
        if ($request->created_at) {
            $order->created_at = $request->created_at;
        }
        // Handle file upload if a screenshot is provided
        if ($request->hasFile('screenshot')) {
            $filePath = $request->file('screenshot')->store('screenshots', 'public'); // Store in 'public/screenshots'
            $order->screenshot = $filePath;
        }

        // Save the order to the database
        $order->save();

        foreach ($request->validated()['collections'] as $collection) {
            if ($collection['id'] ?? null) {
                $orderDetail = OrderDetail::where('id', $collection['id'])->first();
                $orderDetail->update([
                    'order_id' => $order->id,
                    'collection_id' => $collection['collection_id'],
                    'color' => $collection['color'],
                    'size' => $collection['size'],
                    'amount' => $collection['amount']
                ]);
            } else {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'collection_id' => $collection['collection_id'],
                    'color' => $collection['color'],
                    'size' => $collection['size'],
                    'amount' => $collection['amount']
                ]);
            }
        }

        // Return a response (could redirect or return JSON)
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return back()->with('success', 'Order deleted successfully!');
    }

    public function details(Order $order)
    {
        $order->load('delivery');
        $order->total = $order->orderDetails()->sum('amount');

        return inertia("Admin/Orders/Details", [
            'order' => $order,
            'items' => $order->orderDetails()->with('order', 'collection')->paginate(10)
        ]);
    }
}
