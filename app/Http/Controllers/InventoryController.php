<?php

namespace App\Http\Controllers;

use App\Models\CollectionDetail;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function index()
    {
        $searchTerm = request('search');
        return Inertia::render("Admin/Inventories/Index", [
            'inventories' => Inventory::with(['collectionDetail.collection'])
                ->orderBy('created_at', 'desc')
                ->orderBy('updated_at', 'desc')
                ->paginate(),
        ]);
    }

    public function edit(Inventory $inventory)
    {
        return inertia('Admin/Inventories/Edit', [
            'inventory' => $inventory->load('collectionDetail.collection', 'collectionDetail'),
        ]);
    }

    public function update(Inventory $inventory)
    {
        request()->validate([
            'stocks' => 'required|numeric|min:1',
        ]);

        $collectionDetail = CollectionDetail::where('id', $inventory->collection_detail_id)->first();
        if ((request('stocks') - $inventory->stocks) + $collectionDetail->in_stock < 0) {
            return back()->with('error', 'Stocks cannot be less than the total ordered stocks');
        }


        $collectionDetail->update([
            'in_stock' => $collectionDetail->in_stock + (request('stocks') - $inventory->stocks),
            'total_stock' => $collectionDetail->total_stock + (request('stocks') - $inventory->stocks),
        ]);

        $inventory->update([
            'stocks' => request('stocks'),
        ]);

        return redirect()->route('admin.inventories.index')->with('success', 'Inventory updated successfully');
    }

    public function destroy(Inventory $inventory)
    {
        $collectionDetail = CollectionDetail::where('id', $inventory->collection_detail_id)->first();
        if ($collectionDetail->in_stock - $inventory->stocks < 0) {
            return back()->with('error', 'Stocks cannot be less than the total ordered stocks');
        }
        $collectionDetail->update([
            'in_stock' => $collectionDetail->in_stock - $inventory->stocks,
            'total_stock' => $collectionDetail->total_stock - $inventory->stocks,
        ]);
        $inventory->delete();
        return redirect()->route('admin.inventories.index');
    }
}
