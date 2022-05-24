<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Gudang;
use App\Models\Akomodasi;

class RuanganController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the Ruangan page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function ruangan()
    {
        $data = Ruangan::all();
        $no = 1;

        return view('ruangan', compact(
            'data',
            'no'
        ));
    }


    public function detail($id, Ruangan $ruangan)
    {
        $sampah    = Akomodasi::where('total', 0) -> forceDelete();

        $data      = Akomodasi::where('Ruangan_id', $id)->get();
        $identitas = Ruangan::find($id);

        // Sidebar
        $gudang    = Gudang::all();
        $no = 1;

        return view('ruangan.index', compact(
            'identitas',
            'data',
            'gudang',
            'no',
            'ruangan'
        ));
    }


    public function akomodasi($id, $id_brg)
    {
        $data = Akomodasi::find($id);
        $maxData = Gudang::select('total')
                            ->where('barang_id', $id_brg)
                            ->first();
        $barang = $id_brg;
        // Status Stok
        $all = Gudang::all();
        $no = 1;

        return view('ruangan.akomodasi', compact(
            'data',
            'maxData',
            'barang',
            'all',
            'no',
        ));
    }


    public function kembalikan($id, $id_brg)
    {
        $data    = Akomodasi::find($id);
        $maxData = Akomodasi::select('total')
                            ->where('id', $id)
                            ->first();
        $barang = $id_brg;
        // Status Stok
        $gudang = Gudang::all();
        $no = 1;

        return view('ruangan.kembalikan', compact(
            'data',
            'maxData',
            'barang',
            'gudang',
            'no'
        ));
    }


    public function ambil($id)
    {
        $data   = Ruangan::find($id);
        $gudang = Gudang::where('total', '>', 0)
                    ->where('status_id','<','4')
                    ->get();
        return view('Ruangan.ambil', compact(
            'data',
            'gudang',
        ));
    }


    public function konfig_Ruangan()
    {
        $ruangan = Ruangan::paginate(15);
        $no      = 1;

        return view('ruangan.konfig.index', compact(
            'ruangan',
            'no'
        ));
    }


    public function tambah_ruangan()
    {
        return view('ruangan.konfig.tambah');
    }


    public function edit_ruangan($id)
    {
        $ruangan = Ruangan::find($id);

        return view('ruangan.konfig.edit', compact('ruangan'));
    }
}
