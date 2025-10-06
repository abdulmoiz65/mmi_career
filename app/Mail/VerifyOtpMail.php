<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $otp)
    {
        $this->user = $user;
        $this->otp  = $otp;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Verify Your Email - MAJU Career Portal')
                    ->view('emails.verify-otp');
    }
}
