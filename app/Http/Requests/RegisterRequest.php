<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'phone_number'=> 'required',
            'address'=> 'required',
            'password'=> 'required|min:8|max:20'
        ];
    }

    public function messages()
    {
        return [
            //
            'name.required'=> 'Không Được Để Trống Họ Và Tên !',
            'email.required'=> 'Không Được Để Trống Email !',
            'phone_number.required'=> 'Không Được Để Trống Số Điện Thoại !',
            'address.required'=> 'Không Được Để Trống Địa Chỉ !',
            'password.required'=> 'Không Được Để Trống Mật Khẩu !',
            'password.min'=> 'Mật Khẩu Tối Thiểu 8 Ký Tự !',
            'password.max'=> 'Mật Khẩu Tối Đa 20 Ký Tự !',
            'email.email'=> 'Vui Lòng Nhập Đúng Định Dạng Gmail !',
        ];
    }
}
