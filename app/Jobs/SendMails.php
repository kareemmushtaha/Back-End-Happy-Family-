<?php

namespace App\Jobs;

use App\Mail\SendOfStepUserStatusEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->data['type'] == 'admin') {
            foreach ($this->data['admins'] as $admin) {
                Mail::to([$admin->email])->send(new SendOfStepUserStatusEmail($this->data));

            }
        } else {
            Mail::to([$this->data['email'], $this->data['mayor_email'], $this->data['engineer_email']])->send(new SendOfStepUserStatusEmail($this->data));

        }

    }

}
