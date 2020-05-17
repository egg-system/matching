<?php

namespace App\States\Offer;

use App\Models\Offer as OfferModel;
use App\Models\OfferState as OfferStateModel;
use OutOfBoundsException;

abstract class OfferState
{
    protected $state_name = '';

    public const STATE_LIST = [
        UnReply::class,
        Refuse::class,
        Accept::class
    ];

    protected $offer;

    public function __construct(OfferModel $offer)
    {
        $this->offer = $offer;
    }

    /**
     * 状態の切り替えを行う
     *
     * @param string $to
     * @return \App\Models\Offer
     */
    public function transitionTo(string $to)
    {
        if (!in_array($to, self::STATE_LIST, true)) {
            throw new OutOfBoundsException('存在しない状態が参照されました');
        }

        // 同一状態時は無効
        if (get_class($this) === $to) {
            return $this->offer;
        }

        // インスタンス作成
        $to_state = new $to($this->offer);

        // 状態更新
        $this->offer->offer_state = $to_state->getStateId();
        return tap($this->offer)->save();
    }

    /**
     * 名称からIdの取得
     *
     * @return int
     */
    public function getStateId()
    {
        $offer_state = new OfferStateModel();
        $id = optional($offer_state->name($this->state_name)->first())->id;
        return $id;
    }
}
