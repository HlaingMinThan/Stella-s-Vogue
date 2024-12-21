<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderDetailController extends Controller
{
    public function index(Collection $collection)
    {
        $searchTerm = request('search');
        return Inertia::render("Admin/OrderDetails/Index", [
            'order_details' => OrderDetail::whereHas('collectionDetail', function ($query) use ($collection) {
                $query->where('collection_id', $collection->id);
            })
                ->whereHas('order', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%');
                })
                ->with(['collectionDetail', 'order'])
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(15),
            'collection' => $collection,
            'collection_details' => $collection->collectionDetails
        ]);
    }

    public function create(Collection $collection)
    {
        return inertia('Admin/OrderDetails/Create', [
            'collection' => $collection,
            'collection_details' => $collection->collectionDetails
        ]);
    }
    public function edit(OrderDetail $orderDetail)
    {
        return inertia('Admin/OrderDetails/Edit', [
            'orderDetail' => $orderDetail->load('order', 'collection'),
            'collection' => $orderDetail->order->collection,
            'collection_details' => $orderDetail->order->collection->collectionDetails,
        ]);
    }

    public function store(Collection $collection)
    {

        request()->validate([
            'name' => 'required',
            'collection_detail_id' => 'required',
            'pcs' => 'required|min:1|numeric',
        ]);

        $collectionDetail = CollectionDetail::where('id', request('collection_detail_id'))->first();

        if (!$collectionDetail) {
            return back()->with('error', 'Collection Detail Not Found');
        }

        if ($collectionDetail->in_stock < request('pcs')) {
            return back()->with('error', 'Not enough stock');
        }
        $collectionDetail->in_stock = $collectionDetail->in_stock - request('pcs');
        $collectionDetail->save();


        $order = new Order();
        $order->collection_id = $collection->id;
        $order->name = request('name');
        $order->save();

        $order->orderDetails()->create([
            'collection_detail_id' => $collectionDetail->id,
            'pcs' => request('pcs'),
            'amount' => $collectionDetail->price * request('pcs'),
        ]);

        return to_route('admin.order_details.index', ['collection' => $collection->id])->with('success', 'Order created successfully!');
    }
    public function update(OrderDetail $orderDetail)
    {
        request()->validate([
            'name' => 'required',
            'pcs' => 'required|min:1|numeric',
            'collection_detail_id' => 'required'
        ]);

        $collectionDetail = CollectionDetail::where('id', request('collection_detail_id'))->first();


        $remainStockCount = $collectionDetail->id != $orderDetail->collection_detail_id ? $collectionDetail->in_stock : ($collectionDetail->in_stock +   $orderDetail->pcs);
        if ($remainStockCount < request('pcs')) {
            return back()->with('error', 'Not enough stock');
        }
        $orderDetail->collectionDetail->save();
        $orderDetail->amount = $collectionDetail->price * request('pcs');
        if ($orderDetail->collection_detail_id != request('collection_detail_id')) {
            $orderDetail->collection_detail_id = request('collection_detail_id');
            $orderDetail->collectionDetail->in_stock = $orderDetail->collectionDetail->in_stock + $orderDetail->pcs;
            $collectionDetail->in_stock = $collectionDetail->in_stock - request('pcs');
            $collectionDetail->save();
        } else {
            $orderDetail->collectionDetail->in_stock = $orderDetail->collectionDetail->in_stock + $orderDetail->pcs - request('pcs');
        }
        $orderDetail->collectionDetail->save();
        $orderDetail->pcs = request('pcs');
        $orderDetail->save();

        $order = $orderDetail->order;
        $order->name = request('name');
        $order->save();

        return to_route('admin.order_details.index', ['collection' => $collectionDetail->collection->id])->with('success', 'Order updated successfully!');
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->collectionDetail->in_stock = $orderDetail->collectionDetail->in_stock + $orderDetail->pcs;
        $orderDetail->collectionDetail->save();
        $orderDetail->order->delete();
        $orderDetail->delete();

        return to_route('admin.order_details.index', ['collection' => $orderDetail->collectionDetail->collection->id])->with('error', 'Order deleted successfully!');
    }
}
