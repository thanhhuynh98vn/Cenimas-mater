<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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

//    protected $id;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    public function rules()
    {
        $id = $this->request->get('id');
        return [
            'title' => 'required|unique:posts,title,'.$id,
            'description' => 'required',
            'contents' => 'required',
            'slug' => 'required|unique:posts,slug,'.$id,
        ];
    }
}
