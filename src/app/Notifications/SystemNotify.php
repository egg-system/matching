<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Mailable;

class SystemNotify extends Notification
{
    use Queueable;

    protected $mail;

    public function __construct(Mailable $mail)
    {
        $this->mail = $mail;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $systemAddress = config('mail.from.address');
        return ($this->mail)->to([$systemAddress]);
    }
}
