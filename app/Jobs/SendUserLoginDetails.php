<?php

namespace App\Jobs;

use App\Models\User;

use App\Mail\SendLoginDetails;
use Illuminate\Support\Facades\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendUserLoginDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Event data with information
     */
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
    public function handle()
    {
        $mail = new SendLoginDetails($this->user, $this->password);
        Mail::to($this->user->email)->send($mail);
    }
}
