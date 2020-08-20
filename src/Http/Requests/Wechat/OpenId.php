<?php

namespace Zijinghua\Zwechat\Client\Http\Requests\Wechat;

use Illuminate\Foundation\Http\FormRequest;

class OpenId extends FormRequest
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
            'code' => [
                'required'
            ],
        ];
    }

    public function messages()
    {
        return [
            'app_id.required' => '微信appid必填',
            'app_id.in' => '无效的微信appid',
            'code.required' => '微信授权code必填'
        ];
    }
}
