<?php

namespace App\Http\Requests\PageSetting;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Justfeel\Response\ResponseCodes;
use Justfeel\Response\ResponseResult;

class StorePageSettingRequest extends FormRequest
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
            'website_name' => 'required',
            'website_url' => 'required',
            'website_title' => 'required',
            'meta_keyword' => 'required',
            'meta_description' => 'required',
            'email' => 'required',
            'github' => 'required',
            'linkedin' => 'required',
        ];
    }
}
