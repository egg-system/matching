<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Models\Login;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|string|email|max:255',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator): void {
            $login = Login::where('email', $this->input('email'))->first();

            // すでに本登録済みの場合はエラー
            throw_if(
                $login !== null && $login->isRegisteredDefinitive(),
                ValidationException::withMessages([
                    'email' => [trans('validation.custom.auth.register.unique')],
                ]),
            );
        });
    }
}
