<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewAcoountNotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $password_send_to_user = '';
    public $user_name = '';
    public function __construct($random_pass_genarate, $user_name)
    {
        $this->password_send_to_user = $random_pass_genarate;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('backend.mail.NewUserMail', [
            'password_send_to_user' => $this->password_send_to_user,
            'user_name' =>  $this->user_name,
        ]);
    }
}
