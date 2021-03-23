<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'name'          => 'required|max:50',
            'phone_number'  => 'required',
            'address'       => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10240',

        ];
    }

    public function messages()
    {
        return [
            'name.required'          => '店名は必須です。',
            'name.max'               => '店名は50文字以内で記入してください。',
            'phone_number.required'  => '電話番号の入力は必須です。',
            'address.required'       => '住所の入力は必須です。',
            'image.mimes'    => 'ファイルタイプをjpeg,jpg,png,gifに設定してください。',
            'image.max'      => 'ファイルサイズを10MB以下に設定してください。',
        ];
    }
}
