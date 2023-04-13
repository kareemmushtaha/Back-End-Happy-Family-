<?php

namespace App\Notifications;


use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;

class RequestToViewPersonalInformationNotification extends Mailable
{
    use   SerializesModels;

    private $data;
    private $hashToken;
    private $personToDisplay;

    public function __construct($data, $hashToken, $personToDisplay = null)
    {
        $this->data = $data;
        $this->hashToken = $hashToken;
        $this->personToDisplay = $personToDisplay;
    }

    public function build()
    {
        $this->subject("You are assigned to the course")
            ->markdown('emails.viewPersonalInformation', ['user' => $this->data, 'hashToken' => $this->hashToken, 'personToDisplay' => $this->personToDisplay]);
        return response()->json(['status' => true, 'msg' => trans('global.change_status_step_success')]);

    }

}
