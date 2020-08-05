<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferState extends Model
{
    protected $fillable = ['name', 'trainer_notice_flg', 'gym_notice_flg', 'transition_state', 'transition_user_type'];

    /** @var int エントリー */
    public const ENTRY = 1;

    /** @var int オファー */
    public const OFFER = 2;

    /** @var int 内定 */
    public const JOB_OFFER = 3;
    
    /** @var int 成約 */
    public const ACCEPT = 4;
    
    /** @var int 辞退 */
    public const REFUSE = 5;

    /**
     * 状態遷移可能ユーザー判定
     * @param $userType
     * @return bool
     */
    public function canTransitionUser($userType): bool
    {
        return $userType === $this->transition_user_type;
    }

    /**
     * マッチングの初期ステータス判定
     * @return bool
     */
    public function isInitState(): bool
    {
        return $this->id === self::ENTRY || $this->id === self::OFFER;
    }
    
    /**
     * 直近のオファー状態と比較し、遷移可能な状態か判定
     * @param int $recentState
     * @return bool
     */
    public function canTransitionState(int $recentState): bool
    {
        return empty($this->transition_state) ||
            in_array($recentState, explode(',', $this->transition_state));
    }
}
