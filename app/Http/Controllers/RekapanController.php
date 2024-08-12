<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\User;
use App\Models\Menu;

class RekapanController extends Controller
{
    public function index()
    {
        $menu = Menu::all();
        $user = User::all();
        $rekapan = pembayaran::orderBy('id', 'desc')->get();
        return view('kasir.rekapan', compact('rekapan', 'user', 'menu'));
    }

    public function filter(Request $request)
    {
        $tgl_mulai = $request->tgl_mulai;
        $tgl_selesai = $request->tgl_selesai;

        // Query untuk mengambil data rekapan berdasarkan rentang tanggal
        $rekapan = Pembayaran::whereDate('created_at', '>=', $tgl_mulai)
            ->whereDate('created_at', '<=', $tgl_selesai)
            ->get();

        return view('kasir.rekapan', compact('rekapan'));
    }

    public function cetakStruk()
    {
        $usercetak = User::all();
        $cetakStruk = Pembayaran::orderBy('id', 'desc')->get(); // Ubah kecil pembayaran
        $menus = Menu::all(); // Menyesuaikan variabel menus dengan camelCase
        return view('kasir.cetak-struk', compact('cetakStruk', 'usercetak', 'menus'));
    }

    public function show(User $user)
    {
        $menulihat = Menu::findOrFail($user);
        return view('kasir.cetak-struk', compact('menulihat'));
    }


}
