<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index(Collection $collection)
    {
        $searchTerm = request('search');
        return inertia("Admin/OrderDetails/Index", [
            'order_details' => $collection->orderDetails()
                ->with('order', 'collection')
                ->whereHas('order', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->paginate(),
            'collection' => $collection
        ]);
    }

    public function create(Collection $collection)
    {
        return inertia('Admin/OrderDetails/Create', [
            'collection' => $collection
        ]);
    }
    public function edit(OrderDetail $orderDetail)
    {
        return inertia('Admin/OrderDetails/Edit', [
            'orderDetail' => $orderDetail->load('order', 'collection'),
            'collection' => $orderDetail->collection
        ]);
    }

    public function store(Collection $collection)
    {

        request()->validate([
            'name' => 'required',
            'color' => 'required',
            'size' => "required",
            'pcs' => 'required|min:1',
            'amount' => 'required|numeric',
        ]);

        if ($collection->stock < request('pcs')) {
            return back()->with('error', 'Not enough stock');
        }
        $collection->stock = $collection->stock - request('pcs');
        $collection->save();


        $order = new Order();
        $order->name = request('name');
        $order->save();



        $order->orderDetails()->create([
            'collection_id' => $collection->id,
            'color' => request('color'),
            'pcs' => request('pcs'),
            'amount' => request('amount'),
            'size' => request('size')
        ]);

        return to_route('admin.order_details.index', ['collection' => $collection->id])->with('success', 'Order created successfully!');
    }
    public function update(OrderDetail $orderDetail)
    {
        request()->validate([
            'name' => 'required',
            'color' => 'required',
            'size' => "required",
            'pcs' => 'required|min:1',
            'amount' => 'required|numeric',
        ]);
        if ($orderDetail->collection->stock + $orderDetail->pcs < request('pcs')) {
            return back()->with('error', 'Not enough stock');
        }
        $orderDetail->collection->stock = $orderDetail->collection->stock + $orderDetail->pcs - request('pcs');
        $orderDetail->collection->save();
        $orderDetail->color = request('color');
        $orderDetail->pcs = request('pcs');
        $orderDetail->amount = request('amount');
        $orderDetail->size = request('size');
        $orderDetail->save();

        $order = $orderDetail->order;
        $order->name = request('name');
        $order->save();

        return to_route('admin.order_details.index', ['collection' => $orderDetail->collection->id])->with('success', 'Order updated successfully!');
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->collection->stock = $orderDetail->collection->stock + $orderDetail->pcs;
        $orderDetail->collection->save();
        $orderDetail->order->delete();
        $orderDetail->delete();

        return to_route('admin.order_details.index', ['collection' => $orderDetail->collection->id])->with('error', 'Order deleted successfully!');
    }
}
