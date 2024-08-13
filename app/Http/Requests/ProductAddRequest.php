<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:products|max:255|min:10',
            'price' => 'required',
            'category_id' => 'required',
            'content' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'tên sản phẩm not null',
            'name.unique' => 'tên sản phẩm đã tồn tại',
            'name.max' => 'tên sản phẩm không vượt quá 255 ký tự',
            'name.min' => 'tên sản phẩm phải nhiều hơn 10 ký tự',
            'price.required' => 'giá not null',
            'category_id.required' => 'danh mục not null',
            'content.required' => 'nội dung not null'
        ];
    }
}
