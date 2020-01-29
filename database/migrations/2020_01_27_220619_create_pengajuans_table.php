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
            $table->string('no_pengajuan')->comment = 'Nomor Pengajuan';
            $table->string('judul')->comment = 'Judul Pengajuan';
            $table->string('deskripsi')->comment = 'Deskripsi Pengajuan';
            $table->integer('tgl')->comment = 'Tanggal Pengajuan';
            $table->integer('bln')->comment = 'Bulan Pengajuan';
            $table->integer('thn')->comment = 'Tahun Pengajuan';
            $table->integer('mulai')->nullable()->comment = 'TTL Mulai';
            $table->integer('selesai')->nullable()->comment = 'TTL Selesai';
            $table->unsignedBigInteger('iduser')->comment = 'ID User Pengajuan';
            $table->string('id_status')->comment = 'Status Pengajuan';
            $table->unsignedBigInteger('pic')->comment = 'Penanggung Jawab';
            $table->string('berkas')->comment = 'File Pengajuan';

            $table->timestamps();

            $table->foreign('iduser')->references('id_user')->on('users');
            $table->foreign('pic')->references('id')->on('anggotas');

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
