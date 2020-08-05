<?php

namespace App\Http\Requests\Gym;

use App\Http\Requests\SearchRequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class TrainerSearchRequest extends FormRequest implements SearchRequestInterface
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
            'user_id' => 'nullable|integer',
            'user_type' => 'nullable|in:App\Models\Gym,App\Models\Trainer',
            'occupation_id' => 'nullable|integer',
            'area_id' => 'nullable|integer',
            'price' => 'nullable|array',
            'price.min' => 'nullable|integer',
            'price.max' => 'nullable|integer',
            'work_time' => 'nullable|array',
            'work_time.week' => 'nullable|in:月,火,水,木,金,土,日',
            'work_time.time' => 'nullable|date_format:H:i',
        ];
    }

    public function attributes()
    {
        return [
            'occupation_id' => '種類',
            'area_id' => '場所／エリア',
            'price' => '支払い単価',
            'work_time' => '希望する曜日や時間帯',
        ];
    }
}
