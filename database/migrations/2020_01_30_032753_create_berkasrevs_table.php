<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBerkasrevsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkasrevs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_pengajuan')->comment = 'ID Pengajuan';
            $table->unsignedBigInteger('iduser')->comment = 'ID Pengirim';
            $table->string('berkas_revisi')->comment = 'Berkas Revisi';
            $table->string('id_status')->comment = 'ID Status';
            $table->timestamps();

            $table->foreign('id_pengajuan')->references('id')->on('pengajuans');
            $table->foreign('iduser')->references('id_user')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('berkasrevs');
    }
}
