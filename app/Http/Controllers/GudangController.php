<?php

namespace App\Http\Controllers;

use App\Models\Gudang;

class GudangController extends Controller
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

    public function index()
    {
        return view('home');
    }


    public function dasbor()
    {
        return view('index');
    }


    public function data()
    {
        $gudang = Gudang::all();
        $no = 1;
        return view('gudang.data', compact('gudang', 'no'));
    }


    public function gudang()
    {
        return view('gudang.index');
    }
    

    public function sunting_aset_gudang($id)
    {
        $data = Gudang::find($id);

        return view('gudang.edit', ['data' => $data]);
    }


    public function registrasi_aset()
    {
        return view('gudang.registrasi');
    }


    public function sampah()
    {
        $gudang = Gudang::onlyTrashed()->get();
        $no     = 1;
        return view('gudang.sampah', compact(
            'gudang',
            'no'
        ));
    }
}
