<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class ProductRequest extends FormRequest
{
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_name'=>'required|max:100',
            'product_title'=>'required|max:100',
            'product_description' => 'required|min:50,max:400',
            'product_category_id' => 'required',
            'product_price'=>'required|numeric',
            'product_brand'=>'required|max:100',
            'product_model'=>'required|max:100',
            'product_budget'=>'required|numeric',
            'product_seller_id'=>'required',
            'product_images' => 'required|array',
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
}
