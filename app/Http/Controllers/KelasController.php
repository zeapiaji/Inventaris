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


    // public function data_kelas($id)
    // {
    //     dump($id);
    //     $data = Akomodasi::where('kelas_id', $id)->get();
    //     $no   = 1;

    //     return view('kelas.data', compact(
    //         'data',
    //         'no'
    //     ));
    // }


    public function detail($id, Kelas $kelas)
    {
        $sampah    = Akomodasi::where('total', 0) -> forceDelete();

        $data      = Akomodasi::where('kelas_id', $id)->get();
        $identitas = Kelas::find($id);

        // Sidebar
        $gudang    = Gudang::all();
        $no = 1;

        return view('kelas.index', compact(
            'identitas',
            'data',
            'gudang',
            'no',
            'kelas'
        ));
    }


    public function tambah_kelas()
    {
        return view('kelas.konfig.tambah');
    }


    public function konfig_kelas()
    {
        return view('kelas.konfig.index');
    }

    public function data_konfig()
    {
        $kelas = Kelas::all();
        $no    = 1;
        return view('kelas.konfig.data', compact(
            'kelas',
            'no'
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
        $gudang = Gudang::where('total', '>', 0)
                    ->where('status_id','<','4')
                    ->get();
        return view('kelas.ambil', compact(
            'data',
            'gudang',
        ));
    }

}
