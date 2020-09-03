<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends ResetPassword
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('【BorderlessGYM（ボーダーレスジム）】パスワードパスワードをリセットしました')
            ->view('mails.auth.reset', [
                'token' => $this->token,
                'login' => $notifiable,
            ]);
    }
}
