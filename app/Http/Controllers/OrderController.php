<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Static\PaymentOption;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        dd('hit');

        request()->validate([
            'collection_id' => 'nullable|exists:collections,id',
        ]);

        $dateInput = request('date');
        $formattedDate = null;
        // dd($dateInput);
        if ($dateInput) {
            $date = DateTime::createFromFormat('d-m-y', $dateInput);
            if ($date) {
                $formattedDate = $date->format('Y-m-d');
            }
        }



        $collection = \App\Models\Collection::find(request('collection_id'));
        return inertia("Admin/Orders/Index", [
            'collections' => \App\Models\Collection::latest()->get(),
            'orders' => \App\Models\Order::with('collection', 'collection.collectionDetails', 'delivery', 'orderDetails') // Eager load orderDetails
                ->when(request('collection_id'), function ($q) {
                    return $q->where('collection.collectionDetails.collection_id', request('collection_id'));
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
                ->when($formattedDate, function ($q) use ($formattedDate) {
                    return $q->whereDate('created_at', $formattedDate);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(10)
                ->through(fn($order) => [
                    ...$order->toArray(),
                    'amount' => $order->orderDetails->sum('amount'),
                    'editable' => true,
                    'deletable' => auth()->user()->isAdmin() && !$order->orderDetails->count(),
                    'viewable' => true
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
            $order->created_at =  Carbon::parse($request->created_at)->format('Y-m-d H:i:s');
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
                'amount' => $collection['amount'],
                'notes' => $collection['notes']
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
            $requestDate = Carbon::parse($request->created_at)->format('Y-m-d');

            $orderCreatedAt = Carbon::parse($order->created_at)->format('Y-m-d');
            if ($requestDate != $orderCreatedAt) {
                $order->created_at =  Carbon::parse($request->created_at)->format('Y-m-d H:i:s');
            }
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
                    'notes' => $collection['notes'],
                    'amount' => $collection['amount']
                ]);
            } else {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'collection_id' => $collection['collection_id'],
                    'color' => $collection['color'],
                    'notes' => $collection['notes'],
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
        OrderDetail::where('order_id', $order->id)->delete();
        $order->delete();
        return back()->with('success', 'Order deleted successfully!');
    }

    public function orderDetailDelete(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return back();
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
