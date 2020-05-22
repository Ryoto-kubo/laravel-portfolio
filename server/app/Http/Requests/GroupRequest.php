<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'name' => 'required|max:50',
            'image' => 'max:10240|mimes:jpeg,gif,png',
            'users',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'グループ名',
            'image' => '画像',
        ];
    }

    public function passedValidation()
    {
        $this->users = collect($this->users);
    }
}
