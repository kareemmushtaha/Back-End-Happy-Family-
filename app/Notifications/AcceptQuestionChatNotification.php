<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptQuestionChatNotification extends Notification
{
    use Queueable;

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {

        return (new MailMessage())
            ->line(trans('global.question_accepted'))
            ->line(trans('global.question') . ": " . $this->data->question_title)
            ->action(trans('global.go_site'), route('home'))
            ->line(trans('global.thankYouForUsingOurApplication'));
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
