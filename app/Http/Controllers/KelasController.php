<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Akomodasi;
use RealRashid\SweetAlert\Facades\Alert;

class KelasController extends Controller
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
     * Show the kelas page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function kelas()
    {
        // $data   = Gudang::all();

        $data = Kelas::all();
        $no = 1;

        return view('kelas', compact(
            'data',
            'no'
        ));
    }


    public function detail($id)
    {
        $data      = Akomodasi::where('kelas_id', $id)->get();
        $identitas = Kelas::find($id);

        // Bila total 0 maka dihapus
        $sampah    = Akomodasi::where('total', 0) -> forceDelete();
        // Sidebar
        $gudang    = Gudang::all();
        $no = 1;

        return view('kelas.detail', compact(
            'identitas',
            'data',
            'gudang',
            'no'
        ));
    }


    public function tambah_kelas()
    {
        return view('kelas.tambah_kelas');
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

        return view('kelas.akomodasi', compact(
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

        return view('kelas.kembalikan', compact(
            'data',
            'maxData',
            'barang',
            'gudang',
            'no'
        ));
    }

    public function ambil($id)
    {
        $data   = Kelas::find($id);
        $gudang = Gudang::all();
        return view('kelas.ambil', compact(
            'data',
            'gudang',
        ));
    }

}
