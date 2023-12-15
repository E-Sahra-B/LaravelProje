<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('habers', function (Blueprint $table) {
            $table->foreignId('kategori_id')->constrained('categories');
            $table->tinyInteger('status')->default(1)->comment("0 pasif, 1 aktif");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('habers', function (Blueprint $table) {
            //
        });
    }
};
