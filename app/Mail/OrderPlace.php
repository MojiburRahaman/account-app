<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlace extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order_number = '';
    public $user_name = '';
    public function __construct($order_number,$user_name)
    {
        $this->order_number= $order_number;
        $this->user_name= $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your order is placed order #'.$this->order_number)
        ->view('frontend.mail.OrderPlace',[
            'user_name'=> $this->user_name,
            'order_number'=> $this->order_number,
        ]);
    }
}
