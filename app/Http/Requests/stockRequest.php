<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
     * @return array
     */
    public function rules()
{
    return [
        'Product_ID' => 'required|string',
        'Product_Name' => 'required|string',
        'Company_Name' => 'required|string',
        'Weight' => 'required|string|max:255',
        'Manufacture_Date' => 'required|date',
        'Expiration_Date' => 'required|date',
        'Image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];
}

}
