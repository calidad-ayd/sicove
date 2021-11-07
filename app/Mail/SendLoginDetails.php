<?php

namespace App\Mail;


use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLoginDetails extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    protected $password;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $temporalPassword)
    {
        $this->user = $user;
        $this->password = $temporalPassword;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function build()
    {
        $subject = 'Bienvenido a SICOVE Costa Rica';
        return $this->subject($subject)->view('emails.loginDetails', ['user' => $this->user, 'password' => $this->password]);
    }
}
