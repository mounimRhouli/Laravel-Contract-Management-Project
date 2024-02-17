<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $dietels;
    public function __construct($data)
    {
        $this->dietels=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()

    {
        return $this->view('email.emailS')->with('dietels', $this->dietels);

    }
}
