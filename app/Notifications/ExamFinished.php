<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ExamFinished extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public string $name, public string $examName, public int $score, public int $totalScore)
    {
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */

     public function toMail(object $notifiable): MailMessage
     {
         return (new MailMessage)
             ->subject("$this->examName Exam Finished")
             ->greeting('Hello ' . $this->name)
             ->line('We\'re pleased to inform you that the exam "' . $this->examName . '" has been successfully completed.')
             ->line("You got $this->score out of $this->totalScore with a percentage of " . round(($this->score / $this->totalScore) * 100, 2) . "%.")
             ->line('We appreciate your effort and dedication in completing the exam.')
             ->line('Your results are now available for review. And you can log in to your account to view your scores and feedback.')
             ->action('You can view your full scores here at', url('/profile'))
             ->line('Thank you for your participation.')
             ->line('If you have any questions, feel free to reach out to us.')
             ->line('Best regards,')
             ->line('The Exam Team')
             ->salutation('Thank you for using our application!');
     }
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
