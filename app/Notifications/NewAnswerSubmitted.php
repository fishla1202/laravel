<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class NewAnswerSubmitted extends Notification implements ShouldQueue
{
    use Queueable;

    public $answer;
    public $question;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer, $question, $name)
    {
        $this->answer = $answer;
        $this->question = $question;
        $this->name = $name;
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
        return (new MailMessage)
                    ->line("$this->name 在你的問題：". $this->question->title)
                    ->line("提出了新答案：". $this->answer->content)
                    ->action('查看所有答案！', route('questions.show', $this->question->id))
                    ->line('Thank you for using our application!');
    }

    public function toNexmo($notifiable) {
        return (new NexmoMessage)
                    ->content("$this->name 在你的問題： $this->question->title 提交了新答案");
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
