<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Mail\Mailable;

class OfferNotify extends Notification
{
    use Queueable;

    protected $mail;
    protected $to;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mailable $mail, string $to)
    {
        $this->mail = $mail;
        $this->to = $to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return ($this->mail)->to($this->to);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
