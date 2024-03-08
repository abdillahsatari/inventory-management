<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'customer_name' => 'required',
            'customer_phone_number' => 'required',
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
            'customer_name.required' => 'Nama Pelanggan Tidak Boleh Kosong',
            'customer_phone_number.required' => 'No. Hp Pelanggan Tidak Boleh Kosong',
        ];
    }
}
