<?php

namespace Modules\News\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostEditRequest extends FormRequest

{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
//            'title'     =>  'required|unique:news_posts,title,'.request()->segment(3),
            'title' => ['required',Rule::unique('news_posts')->ignore(Request::input('id'), 'id')],
            //'data'      =>  'required',
            'category'  =>  'required',
            'slug'      =>  ['required',Rule::unique('news_posts')->ignore(Request::input('id'), 'id')],
            'post_type' =>  'required'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => trans('news::validation.post_title_required'),
            'title.unique'   => trans('news::validation.post_title_unique'),
            'data.required'  => trans('news::validation.post_data_required'),
            'category.required' => trans('news::validation.post_category_required'),
            'slug.required'  => trans('news::validation.post_slug_required'),
            'slug.unique'    => trans('news::validation.post_slug_unique'),
            'post_type.required' => trans('news::validation.post_type_required')
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
