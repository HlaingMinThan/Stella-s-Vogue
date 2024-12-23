<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionDetail;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RefillController extends Controller
{
    public function index(Collection $collection)
    {
        return Inertia::render('Admin/Refill/Index', [
            'collection' => $collection,
            'collection_details' => $collection->collectionDetails
        ]);
    }

    public function update(Collection $collection)
    {
        $validatedData = request()->validate([
            'collection_details' => ['required', 'array'], // Ensure `collection_details` is an array
            'collection_details.*.id' => ['required', 'integer'],
            'collection_details.*.refill.value' => ['required', 'integer'], // Validate `value` under `stock`
        ]);

        foreach ($validatedData['collection_details'] as $collectionDetail) {
            $collection_detail =  CollectionDetail::where('id', $collectionDetail['id'])->first();
            $collection_detail->update([
                'in_stock' => $collection_detail->in_stock + $collectionDetail['refill']['value'],
                'total_stock' => $collection_detail->total_stock + $collectionDetail['refill']['value']
            ]);
            if ($collectionDetail['refill']['value']) {
                Inventory::create([
                    'collection_detail_id' => $collection_detail->id,
                    'stocks' => $collectionDetail['refill']['value']
                ]);
            }
        }

        return redirect()->route('admin.collections.index')->with('success', 'Collection refilled successfully!');
    }
}
