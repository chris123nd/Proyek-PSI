<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    //membuat tabel database tickets
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin',['Laki-laki','Perempuan']);
            $table->string('instansi');
            $table->string('jenis_perusahaan');
            $table->string('alamat');
            $table->string('email');
            $table->string('negara');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('no_telp');
            $table->string('no_fax');
            $table->string('pekerjaan');
            $table->integer('usia');
            $table->string('layanan');
            $table->string('isi_layanan');
            $table->date('tanggal');
            $table->string('petugas');
            $table->enum('status',['Buka', 'Selesai']);
            $table->integer('survey')->nullable(false);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
