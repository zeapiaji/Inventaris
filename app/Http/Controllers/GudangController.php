<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Barryvdh\DomPDF\Facade\Pdf as PDF;


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


    public function dasbor()
    {
        return view('index');
    }


    public function gudang()
    {
        return view('gudang.index');
    }


    public function data()
    {
        $gudang = Gudang::all();
        $no = 1;

        return view('gudang.data', compact('gudang', 'no'));
    }

    public function sampah()
    {
        return view('sampah.index');
    }

    public function data_sampah()
    {
        $gudang = Gudang::onlyTrashed()->get();
        $no     = 1;
        return view('sampah.data', compact(
            'gudang',
            'no'
        ));
    }
}
