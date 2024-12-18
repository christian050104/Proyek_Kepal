<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Tentukan nama tabel secara eksplisit
    protected $table = 'products';

    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = ['name', 'description', 'price', 'image'];
}
