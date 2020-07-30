<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferState extends Model
{
    protected $fillable = ['name', 'trainer_send_mail', 'gym_send_mail'];

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
}
