<?php

namespace App\Http\Requests\Offer;

use App\Models\OfferState;
use App\Services\MatchingService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'gym' => 'required|different:trainer|exists:login,id',
            'trainer' => 'required|different:gym|exists:login,id',
            'state' => 'required|int|exists:offer_states,id'
        ];
    }

    /**
     * 状態の登録可能判定
     * @return bool
     */
    public function canStoreState(): bool
    {
        $user = Auth::user();
        // 登録可能ユーザーか判定
        $offer_state = OfferState::find($this->state);
        if ($user->user_type !== $offer_state->transition_user_type) {
            return false;
        }

        $recent_offer = app(MatchingService::class)->getMostRecentOffer($this->gym, $this->trainer);

        if (empty($recent_offer)) {
            return true;
        }

        // 登録する状態と直近のオファー状態から遷移可能かを判定する
        return empty($recent_offer->state->transition_state) ||
            in_array($this->state, explode(',', $recent_offer->state->transition_state));
    }

    /**
     * 登録パラメータ取得
     * @return array
     */
    public function getStoreParameter(): array
    {
        return [
            'gym_login_id' => $this->gym,
            'trainer_login_id' => $this->trainer,
            'offer_state' => $this->state,
        ];
    }
}
