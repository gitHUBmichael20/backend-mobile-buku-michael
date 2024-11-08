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
        'penulis',
        'tahun_terbit'
    ];  
    public $timestamps = false;
}