<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['id','menu','id_kategori', 'harga', 'gambar'];
    public $timestamps = true;
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function deleteImage()
    {
        if ($this->error && file_exists(public_path('images/menu' . $this->gambar))) {
            return unlink(public_path('images/menu' . $this->gambar));
        }
    }
}
