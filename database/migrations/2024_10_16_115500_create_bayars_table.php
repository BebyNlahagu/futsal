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
        Schema::create('bayars', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('belum lunas');
            $table->foreignId('jadwal_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal_main');
            $table->integer('durasi');
            $table->integer('total');
            $table->integer('dp');
            $table->integer('bayar');
            $table->integer('sisa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bayars');
    }
};
