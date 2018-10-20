<?php

namespace App\Notifications;

use App\Answer;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMention extends Notification
{
    use Queueable;
    protected $answer ;
    public function __construct(Answer $answer )
    {
        $this->answer = $answer;
    }

    public function via($notifiable)
    {
        return ['database'];
    }
    public function toArray($notifiable)
    {
           return $this->answer->toArray();

    }
}
