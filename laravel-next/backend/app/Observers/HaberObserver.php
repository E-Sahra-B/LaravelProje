<?php

namespace App\Observers;

use App\Models\Haber;

class HaberObserver
{

    public function created(Haber $haber)
    {
        //* * * * * cd /C:\wamp64\www\LaravelProje\haber-bildirim && php artisan schedule:run >> /dev/null 2>&1
    }

    public function updated(Haber $haber)
    {
    }

    public function deleted(Haber $haber)
    {
    }

    public function restored(Haber $haber)
    {
    }

    public function forceDeleted(Haber $haber)
    {
    }
}
