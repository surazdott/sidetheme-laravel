<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $data;
    public $view;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $view)
    {
        $this->data = $data;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        $view = $this->view;

        return $this->subject($data['subject'])->view($view);
    }
}
