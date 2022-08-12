<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
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
            'password'=> 'required|min:8|max:20',
            're_password'=> 'required'
        ];
    }
    public function messages()
    {
        return [
            //
            'password.min'=> 'Mật Khẩu Tối Thiểu 8 Ký Tự !',
            'password.max'=> 'Mật Khẩu Tối Đa 20 Ký Tự !',
        ];
    }
}
