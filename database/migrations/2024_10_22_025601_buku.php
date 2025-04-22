<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    protected $table = 'tabel_buku';
    public function up(): void
    {
        //
        Schema::create($this->table, function(Blueprint $struktur) {
            $struktur->integer('id_buku',true,true);
            $struktur->string('judul_buku',255)->nullable(false);
            $struktur->string('deskripsi_buku',255)->nullable(false);
            $struktur->string('penulis',200)->nullable(false);
            $struktur->integer('tahun_terbit')->nullable(false);
            $struktur->string('sampul_buku')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists($this->table);
    }
};
