<?php

namespace App\Listeners;

use App\Events\NewsAddedEvent;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendNewsAddedEmailListener
{

    public function __construct()
    {
        //
    }

    public function handle(NewsAddedEvent $event)
    {
        $usersMail = User::select('email')->get();
        foreach ($usersMail as $mail) {
            $emails[] = $mail['email'];
            // $user[] = $mail['user'];
        }
        $newsData = $event->news;
        Mail::send('mail.mailcontent', ['haber' => $newsData], function ($message) use ($emails) {
            $message->to($emails)->subject('ESB Haber');
        });
    }
}
