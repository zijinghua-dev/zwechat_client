<?php

namespace Zijinghua\Zwechat\Client\Http\Requests\Wechat;

use Illuminate\Foundation\Http\FormRequest;

class RedirectUrl extends FormRequest
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
            'redirect_url' => [
                'required',
                'url'
            ],
            'scope' => [
                'required',
                'in:snsapi_base,snsapi_userinfo'
            ]
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
