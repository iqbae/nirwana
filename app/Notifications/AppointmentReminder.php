<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// model
use App\Models\Operational\Appointment;
use App\Models\Operational\Doctor;


class AppointmentReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
                    ->subject('Pengingat Janji Temu')
                    ->greeting('Hello ' . $notifiable->name . ',')
                    ->line('Ini adalah pengingat untuk janji temu Anda yang akan datang.')
                    ->line('Date: ' . $this->appointment->date)
                    ->line('Time: ' . $this->appointment->time)
                    ->line('Doctor: ' . $this->appointment->doctor->name)
                    ->line('Antrian: ' . $this->appointment->queue_number)
                    ->action('View Appointment', url('/appointments/' . $this->appointment->id))
                    ->line('Terima kasih telah menggunakan layanan kami.');
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
