<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FoodRequest extends FormRequest
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
            'name'          => 'required|max:70',
            'cooking_time'  => 'required',
            'price'         => 'required',
            'tax_rate'      => 'required',
            'description'      => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => '商品名は必須です。',
            'name.max'               => '商品名は70文字以内で記入してください。',
            'cooking_time.required'  => '調理時間の入力は必須です。',
            'price.required'         => '価格の入力は必須です。',
            'description.required'   => '商品説明の入力は必須です。',
            'tax_rate.required'      => '税率の入力は必須です。',
            'image.mimes'            => 'ファイルタイプをjpeg,jpg,png,gifに設定してください。',
            'image.max'              => 'ファイルサイズを10MB以下に設定してください。',
        ];
    }
}
