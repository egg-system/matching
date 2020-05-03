<?php

namespace App\Http\Requests\Trainer;

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
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'password' => 'required|min:6|max:255|confirmed',
            'name' => 'required',
            'tel' => 'nullable',
            'occupation_id' => 'required|exists:occupations,id',
            'area_id' => 'required|exists:areas,id',
            'pr_comment' => 'nullable|string',
            'hope_price.min' => 'nullable|integer|lt:hope_price.max',
            'hope_price.max' => 'nullable|integer',
            'hope_work_time.week' => 'nullable|in:月,火,水,木,金,土,日',
            'hope_work_time.time' => 'nullable|date_format:H:i',
            'agree' => 'accepted'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'パスワード',
            'name' => '氏名',
            'tel' => '電話番号',
            'occupation_id' => '種類',
            'area_id' => '場所／エリア',
            'pr_comment' => 'PRのコメント',
            'hope_price' => '支払い単価',
            'hope_work_time' => '希望する曜日や時間帯',
            'agree' => '利用規約'
        ];
    }
}
