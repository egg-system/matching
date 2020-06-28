<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;

class OfferNotify extends Notification
{
    use Queueable;

    protected $mail;

    protected $to;

    /**
     * Create a new notification instance.
     *
     * @param Mailable $mail
     * @param string   $to
     */
    public function __construct(Mailable $mail, string $to)
    {
        $this->mail = $mail;
        $this->to = $to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return ($this->mail)->to($this->to);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
        ];
    }
}
