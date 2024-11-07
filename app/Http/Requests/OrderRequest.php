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
        return auth()->user()->isAdmin() || auth()->user()->isStaff();
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
            'address' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'payment' => 'required|string|max:50',
            'delivery_id' => 'required|integer',
            'deli_amount' => 'nullable|numeric|min:0',
            'collections' => 'required|array|min:1',
            'collections.*.collection_id' => 'required|numeric',
            'collections.*.color' => 'required|string',
            'collections.*.size' => 'required|string',
            'collections.*.amount' => 'required|numeric|min:1',
            'collections.*.notes' => 'nullable|string|max:255'
        ];
    }
    public function messages(): array
    {
        return [
            'collections.*.collection_id.required' => 'The collections collection ID field is required.',
            'collections.*.color.required' => 'The collections color field is required.',
            'collections.*.size.required' => 'The collections size field is required.',
            'collections.*.amount.required' => 'The collections amount field is required.',
            'collections.*.amount.min' => 'The collections amount field should be at least 1.',
        ];
    }
}
