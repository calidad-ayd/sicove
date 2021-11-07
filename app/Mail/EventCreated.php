<?php

namespace App\Mail;


use App\Models\Event;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var $event Storage event data
     */

    protected $event;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Una cita para su mascota: '.$this->event->pet->nombre.' ha sido creada';
        $fecha = $this->event->fechaCita . ' '. $this->event->horaCita;
        return $this->subject($subject.' '.$fecha)->view('emails.createdEvent', ['event' => $this->event]);
    }
}
