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
        $day_of_week_role = join(',', trans('search.day_of_week'));

        return [
            'id' => 'required',
            'password' => 'required|min:6|max:255|confirmed',
            'name' => 'required',
            'occupation_id' => 'required|exists:occupations,id',
            'agree' => 'accepted'
        ];
    }

    public function attributes()
    {
        return [
            'password' => 'パスワード',
            'name' => '氏名',
            'occupation_id' => '種類',
            'agree' => '利用規約'
        ];
    }
}
