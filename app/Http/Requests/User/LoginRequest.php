<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseResult::generate(false, $validator->errors(), ResponseCodes::HTTP_UNPROCESSABLE_ENTITY));
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'password' => 'required'
        ];
    }
}
