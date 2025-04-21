<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Reject;
use Illuminate\Http\Request;

class RejectController extends Controller
{
    public function index()
    {
        return inertia('Admin/RejectList/Index', [
            'rejects' => Reject::with('collection')->where('customer_name', 'Like', '%' . request('search') . '%')->orWhereHas('collection', function ($q) {
                return $q->where('name', 'Like', '%' . request('search') . '%');
            })
                ->orderBy('date', 'desc')->paginate(10),
        ]);
    }

    public function create()
    {
        return inertia('Admin/RejectList/Form', [
            'collections' => Collection::all()
        ]);
    }
    public function edit(Reject $reject_list)
    {
        return inertia('Admin/RejectList/Form', [
            'reject_list' => $reject_list,
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
            'error_reason' => 'nullable|string',
            'date' => 'required|date'
        ]);

        Reject::create($validated);

        return redirect()->route('admin.reject_list.index')
            ->with('success', 'Reject created successfully.');
    }

    public function update(Request $request, Reject $reject_list)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'collection_id' => 'required|exists:collections,id',
            'color' => 'required|string',
            'pieces' => 'required|integer|min:1',
            'error_reason' => 'nullable|string',
            'date' => 'required|date'
        ]);

        $reject_list->update($validated);

        return redirect()->route('admin.reject_list.index')
            ->with('success', 'Reject updated successfully.');
    }

    public function destroy(Reject $reject_list)
    {
        $reject_list->delete();

        return redirect()->route('admin.reject_list.index')
            ->with('success', 'Reject deleted successfully.');
    }
}
