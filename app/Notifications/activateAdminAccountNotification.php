<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class activateAdminAccountNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
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
        if ($notifiable->is_active) {
            return (new MailMessage)
                ->subject('Account enabled')
                ->line('Your account has been enabled by Super Admin.')
                ->action('Login', url('/login'))
                ->line('You can now login to your account.');
        } else {
            return (new MailMessage)
                ->subject('Account deactivated')
                ->line('Your account has been deactivated by Super Admin.')
                ->line('You can now login to your account, contact Super Admin for more information.');
        }
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
