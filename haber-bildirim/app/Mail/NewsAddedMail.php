<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
//use app\Models\Haber;
use app\Models\User;

class NewsAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    //public Haber $news;

    public function __construct(User $user)
    {
        $this->user = $user;
        //$this->news = $news;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'ESB Haber',
        );
    }

    public function content()
    {
        return new Content(
            view: 'mail.mailcontent',
            with: ['user' => $this->user]
            // with: ['haber' => $this->news, 'user' => $this->user]
        );
    }

    public function attachments()
    {
        return [];
    }
}
