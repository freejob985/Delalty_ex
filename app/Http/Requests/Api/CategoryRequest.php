<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\FormRequest;

class CategoryRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'category_name'=>'required|min:2|max:50|unique:categories,name'.$this->id,
        ];
    }
}
