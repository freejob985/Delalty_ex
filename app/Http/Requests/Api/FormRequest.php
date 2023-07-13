<?php

namespace App\Http\Requests\Api;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Foundation\Http\FormRequest as OrgFormRequest;
use Illuminate\Contracts\Validation\Validator;
use App\Traits\ApiResponseTrait;
class FormRequest extends OrgFormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
        $this->apiResponse(401,'Validation errors', $validator->errors())
        );
    }

}
