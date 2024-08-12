<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $totalBayar = Pembayaran::sum('total');
        $user = User::all();
    
        // Mendapatkan tanggal mulai dan selesai dari request
        $tgl_mulai = $request->input('tgl_mulai');
        $tgl_selesai = $request->input('tgl_selesai');
    
        // Query untuk mengambil data pembayaran
        $pembayaran = Pembayaran::orderBy('id', 'desc');
    
        // Tambahkan kondisi jika tanggal mulai dan selesai ada
        if ($tgl_mulai && $tgl_selesai) {
            $pembayaran->whereBetween('created_at', [$tgl_mulai, $tgl_selesai]);
        }
    
        // Ambil data yang sudah difilter
        $pembayaran = $pembayaran->get();
    
        return view('admin.pembayaran.index', compact('pembayaran', 'user', 'totalBayar'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menu = menu::all();
        return view('admin.pembayaran.create', compact('menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $pembayaran = new pembayaran();
        $pembayaran->menu = $request->menu;
        $pembayaran->id_user = $request->id_user;
        $pembayaran->subtotal = $request->subtotal;
        $pembayaran->pajak = $request->pajak;
        $pembayaran->total = $request->total;
        $pembayaran->bayar = $request->bayar;
        $pembayaran->kembali = $request->kembali;
        $pembayaran->save();
        return redirect()->route('cetak-struk')->with('success', 'Data berhasil ditambah');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(pembayaran $pembayaran)
    {
        // return view('admin.pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(pembayaran $pembayaran)
    {
        return view('admin.pembayaran.edit', compact('pembayaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pembayaran $pembayaran)
    {   

        $pembayaran->menu = $request->menu;
        $pembayaran->jumlah = $request->jumlah;
        $pembayaran->subtotal = $request->subtotal;
        $pembayaran->pajak = $request->pajak;
        $pembayaran->total = $request->total;
        $pembayaran->bayar = $request->bayar;
        $pembayaran->kembali = $request->kembali;
        $pembayaran->save();
        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pembayaran = pembayaran::FindOrFail($id);
        $pembayaran->delete();
        return redirect()->route('pembayaran.index')->with('success', 'Data berhasil dihapus');
    }
}
