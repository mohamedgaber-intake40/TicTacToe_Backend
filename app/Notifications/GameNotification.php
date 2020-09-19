<?php

namespace App\Notifications;

use App\Models\Game;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class GameNotification extends Notification
{
    use Queueable;

    /**
     * @var \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public $user;
    public $game;

    /**
     * Create a new notification instance.
     *
     * @param Game $game
     */
    public function __construct(Game $game)
    {
        $this->user = Auth::user();

        $game->load('firstPlayer','secondPlayer');
        $this->game = $game;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'user'=>$this->user,
            'game'=>$this->game
        ];
    }

    public function broadcastType()
    {
        return 'game.notification';
    }
}
