<?php

namespace App\Notifications;

use Filament\Facades\Filament;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Password;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected $user)
    {
        //
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

        $token = Password::createToken($this->user);

        $url = Filament::getPanel('member')->getResetPasswordUrl($token, $this->user);

        return (new MailMessage)
            ->subject('Bem-vindo! Crie sua senha')
            ->greeting('Bem-vindo(a)!')
            ->line('Sua conta foi criada com sucesso. Para começar, crie sua senha no botão abaixo.')
            ->action('Criar senha', $url)
            ->line('Se você não solicitou este acesso, pode ignorar este e-mail.');
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
