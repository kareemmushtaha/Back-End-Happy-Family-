<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOfStepUserStatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Build the message.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function build()
    {
        $this
            ->subject($this->data['email'])
            ->markdown('emails.stepUserStatusMail');

        return response()->json(['status' => true, 'msg' => trans('global.change_status_step_success')]);

    }



}
