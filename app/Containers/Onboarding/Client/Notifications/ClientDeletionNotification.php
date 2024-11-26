<?php

namespace App\Containers\Onboarding\Client\Notifications;

use App\Containers\AppSection\User\Models\User;
use App\Containers\Onboarding\Client\Models\Client;
use App\Ship\Parents\Notifications\Notification as ParentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ClientDeletionNotification extends ParentNotification implements ShouldQueue
{
    protected $client;

    /**
     * Create a new notification instance.
     */
    public function __construct(array $client)
    {
        $this->client = $client;
    }

    use Queueable;

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail(User $notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Client Deleted')
            ->line('Client ID: '. $this->client["uuid"])
            ->line('Client Name: '. $this->client["name"])
            ->line('Previous Status: '. $this->client["status"])
            ->line('Status: Deleted');
    }
}
