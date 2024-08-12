<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $user = User::all();
        $rekapan = pembayaran::orderBy('id', 'desc')->get();
        return view('kasir.rekapan', compact('rekapan', 'user'));
    }
    public function filter(request $request)
    {
        $mulai_tanggal = $request->mulai_tanggal;
        $akhir_tanggal = $request->akhir_tanggal;

        $filter = Pembayaran::whereDate('created_at', '>=', $mulai_tanggal)->whereTime('created_at', '<=', $mulai_tanggal)
            ->whereDate('created_at', '<=', $akhir_tanggal)->whereTime('created_at', '<=', $akhir_tanggal)
            ->get();

        return view('kasir.rekapan', compact('filter'));
    }
}
