<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddArtRequest extends FormRequest
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
            'title'=>'required',
            'desn'=>'required',
            'body'=>'required'

        ];

    }
        public function messages()
    {
        return [
            'title.required'=>'标题必填',
            'desn.required'=>'描述必填',
            'body.required'=>'内容必填'

        ];
        
    }
}
