<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RedeemNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $redeemdetails;
    public $parentdet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($parentdet, $redeemdetails)
    {
        $this->redeemdetails = $redeemdetails;
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
        return $this->view('emails.redeem-email')
                    ->from($address, $name)
                    ->replyTo($address, $name)
                    ->with([
                        'redeemdetails' => $this->redeemdetails,
                        'parentdet' => $this->parentdet,
                    ]);
    }
}
