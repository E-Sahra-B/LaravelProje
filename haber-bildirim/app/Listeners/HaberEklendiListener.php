<?php

namespace App\Listeners;

use App\Events\YeniHaberEklendi;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\YeniHaberMail;

class HaberEklendiListener implements ShouldQueue
{
    public function handle($event)
    {
        $users = User::all(); // Kullanıcıları al, isteğe bağlı olarak filtrele

        foreach ($users as $user) {
            Mail::to($user->email)->send(new YeniHaberMail($event->haber));
        }
    }
}
