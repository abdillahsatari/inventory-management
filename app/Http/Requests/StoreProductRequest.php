<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'product_price' => 'required',
            'product_point' => 'required'
        ];
    }


    /**
     * Custom validation error message
     *
     * @return array<string, mixed>
     *
     */
    public function messages()
    {
        return[
            'product_name.required' => 'Nama Produk Tidak Boleh Kosong',
            'product_price.required' => 'Harga Produk Tidak Boleh Kosong',
            'product_point.required' => 'Point Produk Tidak Boleh Kosong',
        ];
    }
}
