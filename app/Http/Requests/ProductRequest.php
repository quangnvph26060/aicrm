<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // cho phép người dùng sử dụng true false là không
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
          'name'=>'required|string|min:6',
            'mota'=>'required|string',
            'gia'=>'required|integer|min:0'
        ];
    }
    // thay đổi thông báo mặc định
    public  function messages()
    {
       return [
           'name.required' => ':attribute không để trống ',
           'name.min' => 'Vui lòng nhập trên :min ký tự',
           'mota.required' => ':attribute không để trống ',
           'gia.required'=>':attribute không để trống',
           'gia.integer'=>':attribute phải là sô',
           'gia.min'=>':attribute phải lớn hơn 0',
       ];
    }
    // thay dổi tên trường
    public function  attributes()
    {
       return [
           'name' => 'Tên Sản Phẩm',
           'mota' => 'Mô tả Sản Phẩm',
           'gia'=> ' Giá Sản Phẩm',
       ];
    }
}
