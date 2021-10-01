<?php

namespace Semaphore\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;

class AlertNotification extends Notification
{
    use Queueable;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!')
            ->line($this->message)
            ->action('Open Semaphore', config('app.url') . '/' . config('semaphore.routes.prefix'));
    }

    public function toSlack($notifiable)
    {
        return (new SlackMessage)
            ->content($this->message);
    }
}
