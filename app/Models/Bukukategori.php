<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bukukategori extends Model
{
    use HasFactory;
    protected $fillable = ['buku_id', 'kategori_id'];

    public function buku (){
        return $this->belongsTo(Buku::class);
    }
    public function kategori (){
        return $this->belongsTo(Kategori::class);
    }
}
