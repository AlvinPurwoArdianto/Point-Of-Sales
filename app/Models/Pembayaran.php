<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = ['id','menu','jumlah', 'subtotal', 'pajak', 'total','bayar', 'kembali'];
    public $timestamps = true;
    // public function menu()
    // {
    //     return $this->belongsTo(Menu::class, 'id_menu');
    // }
}
