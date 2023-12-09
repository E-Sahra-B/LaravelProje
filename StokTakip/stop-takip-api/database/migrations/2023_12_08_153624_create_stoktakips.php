<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stoktakips', function (Blueprint $table) {
            $table->id();
            $table->string('urun_adi');
            $table->decimal('urun_fiyati', 8, 2);
            $table->integer('urun_stok');
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stoktakips');
    }
};
