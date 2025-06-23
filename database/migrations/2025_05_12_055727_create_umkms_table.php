<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal');
            $table->string('negara');
            $table->string('instansi');
            $table->string('provinsi');
            $table->string('jenis_perusahaan')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat');
            $table->integer('usia');
            $table->string('pekerjaan');
            $table->string('no_fax')->nullable();
            $table->enum('status', ['open', 'verifikasi', 'cancel', 'close'])->default('open');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};

