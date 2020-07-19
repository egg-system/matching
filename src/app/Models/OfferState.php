<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class OfferState extends Model
{
    protected $fillable = ['name'];

    /** @var int エントリー(初期状態) */
    public const ENTRY = 1;
    
    /** @var int 正式依頼 */
    public const OFFER = 2;
    
    /** @var int 成約 */
    public const ACCEPT = 3;
    
    /** @var int 辞退 */
    public const REFUSE = 4;
}
