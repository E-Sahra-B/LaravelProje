<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('user_mails', function (Blueprint $table) {
            $table->id();
            $table->string('mail')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_mails');
    }
};
