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
        Schema::create('akomodasi', function (Blueprint $table) {
            $table->id();
            $table->integer('total');
            $table->foreignId('barang_id');
            $table->foreignId('kelas_id');
            $table->foreignId('status_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('barang_id')->references('id')->on('barang');
            $table->foreign('kelas_id')->references('id')->on('kelas');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akomodasi');
    }
};
