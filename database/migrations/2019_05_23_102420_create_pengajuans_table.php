<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_id');
            $table->string('name');
            $table->string('status');
            $table->string('status_bem')->nullable();
            $table->string('status_kmh')->nullable();
            $table->string('penaggungjwb');
            $table->string('berkas');
            $table->string('pengaju');
            $table->text('deskripsi');
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
        Schema::dropIfExists('pengajuans');
    }
}
