<?php

namespace App\Http\Requests\Gym;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        $day_of_week_role = join(',', trans('search.day_of_week'));

        return [
            'name' => 'required',
            'tel' => 'nullable',
            'occupation_id' => 'required|exists:occupations,id',
            'area_id' => 'nullable|exists:areas,id',
            'staff_count' => 'nullable|integer',
            'customer_count' => 'nullable|integer',
            'requirements' => 'nullable|array',
            'requirements.number' => 'nullable|integer',
            'price' => 'nullable|array',
            'price.min' => 'nullable|integer|lt:price.max',
            'price.max' => 'nullable|integer',
            'work_time' => 'nullable|array',
            'work_time.week' => "nullable|in:{$day_of_week_role}",
            'work_time.time' => 'nullable|date_format:H:i',
        ];
    }

    public function attributes()
    {
        return [
            'president_name' => '代表者名',
            'tel' => '電話番号',
            'occupation_id' => '種類',
            'area_id' => '場所／エリア',
            'staff_count' => 'スタッフ数',
            'customer_count' => '顧客数',
            'requirements.*' => '募集要項',
            'price' => '支払い単価',
            'work_time' => '希望する曜日や時間帯',
        ];
    }
}
