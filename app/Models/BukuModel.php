<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;
    protected $table = 'tabel_buku';
    protected $primaryKey = 'id_buku';
    protected $fillable = [
        'judul_buku',
        'deskripsi_buku',
        'penulis',
        'tahun_terbit',
        'sampul_buku'
    ];  
    public $timestamps = false;
}