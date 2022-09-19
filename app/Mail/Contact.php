<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name = '';
    public $email = '';
    public $subject = '';
    public $mail_message = '';
    public function __construct($name, $email, $subject, $mail_message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->subject = $subject;
        $this->mail_message = $mail_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
        ->replyTo($this->email,$this->name)
        ->view('frontend.mail.contact',[
            'name'=> $this->name,
            'text'=> $this->mail_message,
        ]);
        // ->text($this->mail_message);
    }
}
