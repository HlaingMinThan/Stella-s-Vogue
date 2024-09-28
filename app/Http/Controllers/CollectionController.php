<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        return inertia("Admin/Collections/Index", [
            'collections' => Collection::where('name', 'like', '%' . request('search') . '%')
                ->latest()
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
                ]),
        ]);
    }

    public function create()
    {
        return inertia("Admin/Collections/Create", []);
    }

    public function store()
    {
        $validatedData = request()->validate([
            'name' => 'required|string|max:255',
            'fabric' => 'required|integer',
            'under' => 'required|integer',
            'sample_pattern' => 'required|integer',
            'sew_fees' => 'required|integer',
            'model_fees' => 'required|integer',
            'model_deli_fees' => 'nullable|integer',
            'boosting' => 'nullable|integer',
            'phone_bill' => 'nullable|integer',
            'packing_fees' => 'nullable|integer',
            'extra_charges' => 'nullable|integer',
            'taxi_charges' => 'nullable|integer',
            'ga__vlog_charges' => 'nullable|integer',
            'stock' => 'required|integer',
        ]);

        // Create the collection
        Collection::create($validatedData);

        // Redirect back or to a specific route with success message
        return redirect()->route('admin.collections.index')->with('success', 'Collection created successfully!');
    }
}
