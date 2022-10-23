<?php

namespace App\Notifications\Guest;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Mail\InquiryReceived as InquiryReceivedMailable;
use App\Models\Inquiry;

class InquiryReceivedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $inquiry;

    public function __construct(Inquiry $inquiry)
    {
        $this->inquiry = $inquiry;
        $this->afterCommit();

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
     * @return Mailable
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //             ->from(env('MAIL_FROM_ADDRESS'), 'Leopard Glamping')
        //             ->subject('We have recieved your inquiry!')
        //             ->line('Your inquiry has been placed!')
        //             ->line('Please be patient while we checking the availability with authorities.')
        //             ->line('Great things are coming ahead!');

        return (new InquiryReceivedMailable())
            ->from(env('MAIL_FROM_ADDRESS'), 'Leopard Glamping')
            ->subject('Acknowledgement')
            ->to($notifiable->email);
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
