<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Request;

class MyResetPassword extends Notification
{
    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
        $url = route('frontend.password.reset', $this->token);
        if(Request::route()->getPrefix() === '/admin'){
            $url = route('admin.password.reset', $this->token);
        }
        return (new MailMessage)
            ->subject('Yêu cầu thay đổi mật khẩu')
            ->line('Bạn đã nhận yêu cầu chuỗi thay đổi password. hãy vào đường link để thay đổi password')
            ->action('Thay đổi mật khẩu', $url)
            ->line('Nếu bạn không yêu cầu thì vui lòng đổi lại mật khẩu ngay lập tức.');
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
