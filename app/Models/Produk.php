<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'tbl_produk';
    protected $fillable = ['id', 'nama_produk', 'image', 'harga', 'stock', 'created_at', 'updated_at'];
}
