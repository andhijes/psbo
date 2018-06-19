<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Http\Controllers\ScholarshipController;
use Illuminate\Http\Request;
use App\scholarship;
use App\requirement;

class TutorialPublished extends Notification
{
    use Queueable;

    protected $tuto;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tutorial)
    {
        $this->tuto=$scholarships;
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
                    ->subject('Beasiswa Yang Cocok Untukmu Telah Hadir!')
                    ->line($this->tuto->name)
                    ->action('Masuk ke website', url('/'))
                    ->line('Semoga harimu menyenangkan!');
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
