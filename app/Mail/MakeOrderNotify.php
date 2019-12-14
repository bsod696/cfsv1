<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MakeOrderNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $parentdet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parentdet)
    {
        $this->parentdet = $parentdet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = 'cfs.oracle@gmail.com';
        $name = 'Canteen Food System';
        return $this->view('emails.makeorder-email')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->with([
                        'parentdet' => $this->parentdet,
                    ]);
    }
}
