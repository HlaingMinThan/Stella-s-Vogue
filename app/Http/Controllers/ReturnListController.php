<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\ReturnList;
use Illuminate\Http\Request;

class ReturnListController extends Controller
{
    public function index()
    {
        return inertia('Admin/ReturnList/Index', [
            'returns' => ReturnList::with('collection')->where('customer_name', 'Like', '%' . request('search') . '%')->orWhereHas('collection', function ($q) {
                return $q->where('name', 'Like', '%' . request('search') . '%');
            })
                ->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return inertia('Admin/ReturnList/Form', [
            'collections' => Collection::all()
        ]);
    }
    public function edit(ReturnList $returnList)
    {
        return inertia('Admin/ReturnList/Form', [
            'return_list' => $returnList,
            'collections' => Collection::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'collection_id' => 'required|exists:collections,id',
            'color' => 'required|string',
            'pieces' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'date' => 'required|date'
        ]);

        ReturnList::create($validated);

        return redirect()->route('admin.return_list.index')
            ->with('success', 'Return created successfully.');
    }

    public function update(Request $request, ReturnList $returnList)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'collection_id' => 'required|exists:collections,id',
            'color' => 'required|string',
            'pieces' => 'required|integer|min:1',
            'note' => 'nullable|string',
            'date' => 'required|date'
        ]);

        $returnList->update($validated);

        return redirect()->route('admin.return_list.index')
            ->with('success', 'Return updated successfully.');
    }

    public function destroy(ReturnList $returnList)
    {
        $returnList->delete();

        return redirect()->route('admin.return_list.index')
            ->with('success', 'Return deleted successfully.');
    }
}
