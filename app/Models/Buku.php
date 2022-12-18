<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $dates = ['tgl_terbit'];
    protected $fillable = ['judul', 'buku_seo', 'penulis', 'harga', 'tgl_terbit'];

    public function photos() {
        return $this->hasMany(Galeri::class, 'id_buku', 'id');
    }
    
    public function comments() {
        return $this->hasMany(Komentar::class, 'id_buku', 'id');
    }
}