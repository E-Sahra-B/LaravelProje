<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YeniHaberMail extends Mailable
{
    use Queueable, SerializesModels;

    public $haber;

    public function __construct($haber)
    {
        $this->haber = $haber;
    }

    public function build()
    {
        return $this->view('mail.yeni-haber');
    }
}
