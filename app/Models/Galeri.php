<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';

    public function albums() {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }
}
