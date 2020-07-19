<?php

namespace App\Http\Requests\Offer;

use App\Models\OfferState;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return [
            'offerState' => [
                "required",
                Rule::exists('offer_states', 'id')->where(function ($query) {
                    $query->where('id', '<>', OfferState::ENTRY);
                })
            ]
        ];
    }
}
