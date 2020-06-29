<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FangRequest extends FormRequest
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
            'fang_name'=>'required',
            'fang_xiaoqu'=>'required',
            // 'fang_province'=>'numeric|min:1'
        ];
    }

      public function messages()
    {
        return [
            'fang_name.required'=>'房源名称必填',
            'fang_xiaoqu.required'=>'小区名称必填',    

        ];
        
    }
}
