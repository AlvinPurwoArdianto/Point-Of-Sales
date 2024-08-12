<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = Menu::orderBy('id', 'desc')->get();
        $kategori = Kategori::orderBy('id', 'desc')->get();

        return view('admin.menu.index', compact('menu','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('admin.menu.create',compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'menu' => 'required|unique:menus,menu'
        ],
    
        [
            'menu.required' => 'Nama harus diisi',
            'menu.unique' => 'Menu dengan nama tersebut sudah ada sebelumnya.',
        ]
    );

        $menu = new menu();
        $menu->menu = $request->menu;
        $menu->id_kategori = $request->id_kategori;
        $menu->harga = $request->harga;
        $menu->gambar = $request->gambar;

        // update img
         if ($request->hasFile('gambar')) {
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/menu', $name);
            $menu->gambar = $name;
        }

        $menu->save();

        return redirect()->route('menu.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return view('admin.menu.show', compact('menu'));
    }               

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    
    {
        $kategori = kategori::all();
        return view('admin.menu.edit', compact('menu','kategori'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,menu $menu)
    {
        $menu->menu = $request->menu;
        $menu->id_kategori = $request->id_kategori;
        $menu->harga = $request->harga;
        $menu->gambar = $request->gambar;

        // delete img
        if ($request->hasFile('gambar')) {
            $menu ->deleteImage();
            $img = $request->file('gambar');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/menu', $name);
            $menu->gambar = $name;
        }

        $menu->save();
        return redirect()->route('menu.index')->with('success', 'Data berhasil diubah');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::FindOrFail($id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Data berhasil dihapus');
    }
    
}
