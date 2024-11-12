<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function build()
    {
        return $this->view('emails.test_email') // your Blade view for the email
                    ->with(['id' => $this->id]);
    }
}
