<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\CollectionDetail;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CollectionController extends Controller
{
    public function index()
    {
        return inertia("Admin/Collections/Index", [
            'collections' => Collection::with('collectionDetails')
                ->where('name', 'like', '%' . request('search') . '%')
                ->orderBy("updated_at", 'desc')
                ->paginate(10)
                ->through(fn($collection) => [
                    'id' => $collection->id,
                    'name' => $collection->name,
                    'fabric' => $collection->fabric,
                    'under' => $collection->under,
                    'sample_pattern' => $collection->sample_pattern,
                    'sew_fees' => $collection->sew_fees,
                    'model_fees' => $collection->model_fees,
                    'model_deli_fees' => $collection->model_deli_fees,
                    'boosting' => $collection->boosting,
                    'phone_bill' => $collection->phone_bill,
                    'packing_fees' => $collection->packing_fees,
                    'extra_charges' => $collection->extra_charges,
                    'ga__vlog_charges' => $collection->ga__vlog_charges,
                    'taxi_charges' => $collection->taxi_charges,
                    'stock' => $collection->stock,
                    'sum' => $collection->sum, // Access the virtual property
                    'collection_details' => $collection->collectionDetails,
                    'deletable' => !$collection->collectionDetails()->whereHas('orderDetails')->exists(),
                ]),
        ]);
    }

    public function create()
    {
        return inertia("Admin/Collections/Create", []);
    }
    public function edit(Collection $collection)
    {
        return inertia("Admin/Collections/Edit", [
            'collection' => $collection,
            'collection_details' => $collection->collectionDetails
        ]);
    }

    public function store()
    {
        $validatedData = request()->validate([
            'collection_name' => ['required'],
            'collection_details' => ['required', 'array'], // Ensure `collection_details` is an array
            'collection_details.*.color.value' => ['required', 'string'], // Validate `value` under `color`
        ], [
            'collection_name.required' => 'The collection name is required.',
            'collection_details.required' => 'Collection details are required.',
            'collection_details.*.color.value.required' => 'Color is required for each collection detail.',
        ]);

        // Create the collection
        $collection = Collection::create([
            'name' => $validatedData['collection_name']
        ]);

        foreach ($validatedData['collection_details'] as $collection_detail) {
            foreach (['sm', 'md', 'lg'] as $size) {
                $collectionDetail = CollectionDetail::create([
                    'collection_id' => $collection->id,
                    'color' => $collection_detail['color']['value'],
                    'size' => $size,
                    'price' => 0,
                    'total_stock' => 0,
                    'in_stock' => 0,
                ]);
            }
        }
        // Redirect back or to a specific route with success message
        return redirect()->route('admin.collections.index')->with('success', 'Collection created successfully!');
    }

    public function update(Request $request, Collection $collection)
    {
        // Validate the incoming data
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'fabric' => 'required|numeric|min:0',
        //     'under' => 'required|numeric|min:0',
        //     'sample_pattern' => 'required|numeric|min:0',
        //     'sew_fees' => 'required|numeric|min:0',
        //     'model_fees' => 'required|numeric|min:0',
        //     'model_deli_fees' => 'required|numeric|min:0',
        //     'boosting' => 'required|numeric|min:0',
        //     'phone_bill' => 'required|numeric|min:0',
        //     'packing_fees' => 'required|numeric|min:0',
        //     'extra_charges' => 'required|numeric|min:0',
        //     'taxi_charges' => 'required|numeric|min:0',
        //     'ga__vlog_charges' => 'required|numeric|min:0',
        //     'stock' => 'required|numeric|min:0',
        // ]);
        $validatedData = request()->validate([
            'collection_name' => ['required'],
            'collection_details' => ['required', 'array'],
            'collection_details.*.id' => ['nullable'],
            'collection_details.*.color.value' => ['required', 'string'],
            'collection_details.*.price.value' => ['required'],
            'collection_details.*.size.value' => ['required', 'string'],
            'collection_details.*.stock.value' => ['required', 'integer'],
        ], [
            'collection_name.required' => 'The collection name is required.',
            'collection_details.required' => 'Collection details are required.',
            'collection_details.*.color.value.required' => 'Color is required for each collection detail.',
            'collection_details.*.color.value.string' => 'Color must be a string.',
            'collection_details.*.price.value.required' => 'Price is required for each collection detail.',
            'collection_details.*.size.value.required' => 'Size is required for each collection detail.',
            'collection_details.*.size.value.string' => 'Size must be a string.',
            'collection_details.*.stock.value.required' => 'Stock is required for each collection detail.',
            'collection_details.*.stock.value.integer' => 'Stock must be an integer.',
        ]);

        try {
            $updatedIds = [];
            DB::transaction(function () use ($validatedData, $collection) {
                foreach ($validatedData['collection_details'] as $collectionDetail) {
                    if (key_exists('id', $collectionDetail)) {
                        $existCollectionDetail = CollectionDetail::where('id', $collectionDetail['id'])->first();
                        if (($collectionDetail['stock']['value'] - $existCollectionDetail->total_stock) + $existCollectionDetail->in_stock < 0) {
                            throw new \Exception('You already sold ' . ($existCollectionDetail->total_stock - $existCollectionDetail->in_stock) . ' items of ' . $collection->name . ' with size ' . $existCollectionDetail->size . ' and color ' . $existCollectionDetail->color);
                        }

                        if ($existCollectionDetail->total_stock == 0 && $collectionDetail['stock']['value']) {
                            Inventory::create([
                                'collection_detail_id' => $existCollectionDetail->id,
                                'stocks' => $collectionDetail['stock']['value']
                            ]);
                        }
                        $existCollectionDetail->update([
                            'color' => $collectionDetail['color']['value'],
                            'size' => $collectionDetail['size']['value'],
                            'price' => $collectionDetail['price']['value'],
                            'total_stock' => $collectionDetail['stock']['value'],
                            'in_stock' => ($collectionDetail['stock']['value'] - $existCollectionDetail->total_stock) + $existCollectionDetail->in_stock
                        ]);
                        $updatedIds[] = $existCollectionDetail->id;
                    } else {
                        $collection_detail = CollectionDetail::create([
                            'collection_id' => $collection->id,
                            'color' => $collectionDetail['color']['value'],
                            'size' => $collectionDetail['size']['value'],
                            'price' => $collectionDetail['price']['value'],
                            'total_stock' => $collectionDetail['stock']['value'],
                            'in_stock' => $collectionDetail['stock']['value']
                        ]);
                        $updatedIds[] = $collection_detail->id;
                        Inventory::create([
                            'collection_detail_id' => $collection_detail->id,
                            'stocks' => $collection_detail->total_stock
                        ]);
                    }
                }

                CollectionDetail::where('collection_id', $collection->id)->whereNotIn('id', $updatedIds)->delete();

                // Update the collection with validated data
                $collection->update([
                    'name' => $validatedData['collection_name']
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        // Redirect back with a success message
        return redirect()->route('admin.collections.index', ['collection' => $collection->id])->with('success', 'Collection updated successfully!');
    }

    public function destroy(Collection $collection)
    {
        $collection->delete();
        return back()->with('success', 'Collection deleted successfully!');
    }
}
