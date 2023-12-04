<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Haber;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class MailCronJob extends Command
{
    protected $signature = 'app:mail-cron';
    protected $description = 'Daily send mail all users';
    public function handle()
    {
        $usersMail = User::select('email')->get();
        $haber = Haber::all();
        foreach ($usersMail as $mail) {
            $emails[] = $mail['email'];
        }
        Mail::send('mail.mailcroncontent', ['haberler' => $haber], function ($message) use ($emails) {
            $message->to($emails)->subject('ESB Haber Gün Sonu');
        });
    }
}
