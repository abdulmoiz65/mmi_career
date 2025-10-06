<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public int $minutes;

    public function __construct(string $otp, int $minutes = 10)
    {
        $this->otp = $otp;
        $this->minutes = $minutes;
    }

    public function build()
    {
        return $this->subject('Your MAJU Career password reset code')
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                        'minutes' => $this->minutes,
                    ]);
    }
}
