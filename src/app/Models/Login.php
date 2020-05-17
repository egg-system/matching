<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Login extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $table = 'login';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        // メールを送信
        $this->notify(new \App\Notifications\VerifyEmail);
    }

    public function user()
    {
        return $this->morphTo('user');
    }

    /**
     * パスワードのハッシュ化
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * 更新するカラムで属性を上書きしたモデルを取得
     * @param array $update_columns = []
     * @return \App\Modes\Login
     */
    public function fillUpdateColumns(array $update_columns = [])
    {
        $attr = array_merge($this->getAttributes(), $update_columns);
        return $this->fill($attr);
    }

    public function from_offers()
    {
        return $this->hasMany(Offer::class, 'offer_from_id', 'id');
    }

    /**
     * トレーナーだけに限定するクエリスコープ
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOnlyTrainer(Builder $query, int $user_id = null)
    {
        return $query->where('user_type', Trainer::class)
            ->when($user_id, function ($builder, $user_id) {
                return $builder->where('user_id', $user_id);
            });
    }
}
