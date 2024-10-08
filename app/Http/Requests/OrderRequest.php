<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'collection_id' => 'required|exists:collections,id',
            'color' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'payment' => 'required|string|max:50',
            'screenshot' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // 2MB max
            'delivery_id' => 'required|integer',
            'notes' => 'nullable|string|max:600',
            'amount' => 'required|numeric|min:0',
        ];
    }
}
