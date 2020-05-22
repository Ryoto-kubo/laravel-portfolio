<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|max:50',
            'team_name' => 'required|max:50',
            'image' => 'max:10240|mimes:jpeg,gif,png',
            'prefecture_id' => 'required',
            'activity_place' => 'required|max:100',
            'activity_time' => 'required|max:100',
            'description' => 'required|max:500',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'タイトル',
            'team_name' => 'チーム名',
            'image' => '画像',
            'prefecture_id' => '都道府県',
            'activity_place' => '活動場所',
            'activity_time' => '活動時間',
            'description' => '詳しい説明',
        ];
    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
            ->slice(0, 3)
            ->map(function ($requestTag) {
                return $requestTag->text;
            });
    }
}
