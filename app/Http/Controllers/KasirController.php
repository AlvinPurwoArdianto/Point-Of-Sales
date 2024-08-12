<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function menampilkan(Request $request){
        $menu = Menu::orderBy('id', 'desc')->get();
        $kategori = Kategori::all();
        $pembayaran = Pembayaran::all();
   return view('kasir.frontend', compact('menu','pembayaran','kategori'));
    }

    public function show(menu $menu, kategori $kategori)
    {
        $menu = Menu::findOrFail($menu);
        $kategori = Kategori::findOrFail($kategori);
        return view('kasir.frontend',compact('menu','kategori'));
    }


   
    
    


}
