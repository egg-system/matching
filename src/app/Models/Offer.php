<?php

namespace App\Models;

use App\States\Offer\UnReply;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $state;

    protected $fillable = [
        'offer_from_id',
        'offer_to_id',
        'offer_state',
        'message',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // デフォルトのステータス
        $this->state = new UnReply($this);
    }

    /**
     * 状態遷移
     *
     * @param string $to
     * @return \App\Models\Offer
     */
    public function transitionTo(string $to)
    {
        return $this->state->transitionTo($to);
    }

    /**
     * デフォルトステータス値取得
     *
     * @return int
     */
    public function getDefaultStateId()
    {
        return $this->state->getStateId();
    }

    public function state()
    {
        return $this->hasOne(OfferState::class, 'id', 'offer_state');
    }
}
