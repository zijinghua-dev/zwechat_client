<?php
namespace Zijinghua\Zwechat\Client\Http\Requests\Wechat;

use Illuminate\Foundation\Http\FormRequest;

class JssdkConfig extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'url' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        return [
            'url.required' => '请传入您调用微信js sdk所在页面的URL, url需要提前encode'
        ];
    }
}
