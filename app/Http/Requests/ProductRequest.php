<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //
            'name' => 'required',
            'price' => 'required',
            'insurance' => 'required',
            'size' => 'required',
            'category_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'avatar.required' => 'Cần Chọn Một Ảnh Đại Diện !',
            'name.required' => 'Không Được Để Trống Tên Sản Phẩm !',
            'price.required' => 'Không Được Để Trống Giá Sản Phẩm !',
            'insurance.required' => 'Không Được Để Trống Chất Liệu !',
            'size.required' => 'Không Được Để Trống Kích Thước !',
        ];
    }
}
