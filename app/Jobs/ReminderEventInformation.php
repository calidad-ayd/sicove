<?php

namespace App\Jobs;

use App\Models\Event;
use App\Mail\ReminderMail;

use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReminderEventInformation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $pendingNotify;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $current = Carbon::now('America/Costa_Rica')->addDay();
        $this->pendingNotify = Event::whereNull('notified_at')->WhereDate('fechaCita', $current->toDateString())->whereTime('horaCita', $current->second(0)->toTimeString())->get();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->pendingNotify as $notify) {
            $mail = new ReminderMail($notify);
            Mail::to($notify->pet->client->correo)->send($mail);

            $temporalEvent = Event::find($notify->id);
            $temporalEvent->notified_at = Carbon::now('America/Costa_Rica');
            $temporalEvent->save();
        }
    }
}
