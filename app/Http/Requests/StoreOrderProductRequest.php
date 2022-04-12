<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order_id' => ['required', 'exists:orders,id'],
            'product_id' => ['required', 'exists:products,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
