<?php

namespace App\Http\Requests\Post;

use App\Models\Statuses;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseResult::generate(false, $validator->errors(), ResponseCodes::HTTP_UNPROCESSABLE_ENTITY));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'uuid' => 'required',
            'title' => 'required',
            'description' => 'required',
            'status_id' => 'required',
            'created_by_user_id' => 'required',
        ];
    }
}
