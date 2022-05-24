<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Akomodasi;
use Illuminate\Http\Request;
use App\Http\Requests\RuanganFormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RuanganJumlahFormRequest;
use App\Http\Requests\RuanganRequest;

class DBrequest extends Controller
{
    /**
     * Casting untuk meringankan data saat request data ke db.
     */

    /* String -> Int
    *  $nomor = '2313';
    *  $num = json_decode($nomor);
    *  var_dump($num);

    *  Int -> String
    *  $no = 1123123;
    *  $string = (string)$no;
    *  var_dump($string);
    */

    // public function __construct()
    // {
    //     $this->middleware(function($request,$next){
    //         if (session('success')) {
    //             Alert::success(session('success'));
    //         }

    //         if (session('error')) {
    //             Alert::error(session('error'));
    //         }

    //         return $next($request);
    //     });
    // }

    /*
    |--------------------------------------------------------------------------
    | Gudang
    |--------------------------------------------------------------------------
    */

    public function unggah(Request $request)
    {
        try {
            if ($request->ajax()){

            Barang::create([
                'nama' => $request -> nama_brg,
                'kode' => $request -> kode_brg,
            ]);

            $dataBarang = Barang::select('id')
                            ->orderByRaw('id DESC')
                            ->first();

             Gudang::create([
                'barang_id' => $dataBarang ->id,
                'total'     => $request -> jumlah,
                'status_id' => $request -> status,
            ]);

            Alert::toast('Aset berhasil ditambahkan!', 'success');
            return response()->json(['success' => 'Data berhasil diregistrasi!']);
            }
        } catch (\Throwable $th) {
            Alert::toast('Aset gagal ditambahkan!', 'error');
            return redirect('/gudang');
        }

    }


    public function perbarui(Request $request)
    {
        $validator = Validator::make($request -> all(), [
            'nama_brg' => 'required',
            'kode_brg' => 'required',
            'jumlah' => 'required',
            'status' => 'required',
        ]);

        if ($validator-> fails()) {
            return response()->json([
                'error' => $validator -> errors()->all()
            ]);
        }

        try {
            if($request -> ajax()){
                $id     = $request -> id;

                $barang = Barang::find($id);
                $barang -> nama = $request -> nama_brg;
                $barang -> kode = $request -> kode_brg;

                $gudang = Gudang::find($id);
                $gudang -> total = $request -> jumlah;
                $gudang -> status_id = $request -> status;

                $gudang -> update();
                $barang -> update();

                Alert::toast('Aset berhasil diperbarui!', 'success');
                return response()->json(['success' => 'Data berhasil diregistrasi!']);
            }
        } catch (\Throwable $th) {
            Alert::toast('Aset gagal diperbarui!', 'error');
            return redirect()->back();
        }

    }


    /*
    |--------------------------------------------------------------------------
    | Ruangan
    |--------------------------------------------------------------------------
    */
    public function akomodasi_aset(RuanganJumlahFormRequest $request, $id, $id_brg)
    {
        $request -> validated();

        try {
            $gudang          = Gudang::where('id', $id_brg) -> first();
            $prosesGudang    = $gudang -> total - $request -> jumlah;
            $gudang -> total = $prosesGudang;

            $akomodasi       = Akomodasi::where('id', $id)->first();
            $prosesAkomodasi = $akomodasi -> total  + $request -> jumlah;
            $akomodasi -> total = $prosesAkomodasi;

            $gudang -> save();
            $akomodasi -> save();

            $ruangan = Akomodasi::where('id', $id)->first();
            $ruangan = $ruangan -> ruangan -> id;

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil ditambahkan!', 'success');
            return redirect('/ruangan/'.$ruangan);

        } catch (\Throwable $th) {
            $ruangan = Akomodasi::where('id', $id)->first();
            $ruangan = $ruangan -> ruangan -> id;

            Alert::toast('Ada yang salah, silahkan coba lagi nanti!', 'error');
            return redirect('/ruangan/'.$ruangan);
        }

    }


    public function kembalikan_aset(RuanganJumlahFormRequest $request, $id, $id_brg)
    {
        $request ->validated();

        try {
            $gudang             = Gudang::where('barang_id', $id_brg)->first();
            $prosesGudang       = $gudang -> total + $request->jumlah;
            $gudang -> total    = $prosesGudang;

            $akomodasi          = Akomodasi::where('id', $id)->first();
            $prosesAkomodasi    = $akomodasi -> total - $request -> jumlah;
            $akomodasi -> total = $prosesAkomodasi;

            $gudang     -> save();
            $akomodasi  -> save();

            $ruangan = Akomodasi::where('id', $id)->first();
            $ruangan = $ruangan -> ruangan -> id;

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil dikembalikan!', 'success');
            return redirect('/ruangan/'.$ruangan);
        } catch (\Throwable $th) {
            $ruangan = Akomodasi::where('id', $id)->first();
            $ruangan = $ruangan -> ruangan -> id;

            Alert::toast('Ada yang salah, silahkan coba lagi nanti!', 'error');
            return redirect('/ruangan/'.$ruangan);
        }

    }


    public function ambil_aset(RuanganFormRequest $request, $id)
    {
        $request -> validated();

        try {
            $gudang = Gudang::where('barang_id', $request -> nama_brg)
                        ->where('status_id', $request -> status)
                        ->first();

            if ($request -> jumlah <= $gudang -> total) {
                $prosesGudang    = $gudang -> total - $request -> jumlah;
                $gudang -> total = $prosesGudang;
                $gudang -> save();
            }else{
                $ruangan = Akomodasi::where('ruangan_id', $id)->first();
                $ruangan = $ruangan -> ruangan -> id;
                Alert::toast('Aset digudang terlalu sedikit, kurangi request jumlah!', 'error');
                return redirect('/ruangan/'.$ruangan);
            }

            Akomodasi::create([
                'total'     => $request -> jumlah,
                'barang_id' => $request -> nama_brg,
                'ruangan_id'  => $id,
                'status_id' => $request -> status,
            ]);

            $ruangan = Akomodasi::where('ruangan_id', $id)->first();
            $ruangan = $ruangan -> ruangan -> id;
            Alert::toast($gudang -> barang -> nama . ' berhasil diambil!', 'success');
            return redirect('/ruangan/'.$ruangan);

        } catch (\Throwable $th) {
            Alert::toast('Barang tidak ditemukan, silahkan periksa lagi!', 'error');
            return redirect()->back();
        }

    }


    public function hapus_aset_gudang(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request -> id;
                Gudang::find($id) -> delete();

                return response()->json(['status' => true, 'message'=>'aset berhasil dihapus']);
            }
        } catch (\Throwable $th) {
            Alert::toast('Aset gagal dihapus!', 'error');
            return redirect()->back();
        }

    }


    public function unggah_ruangan(RuanganRequest $request)
    {
        try {
            Ruangan::create([
                'nama' => $request -> ruangan
            ]);

            Alert::toast('Ruangan '. $request -> ruangan.' berhasil ditambahkan!', 'success');
            return redirect('/ruangan');
        } catch (\Throwable $th) {
            Alert::toast('Ruangan '. $request -> ruangan.' gagal ditambahkan!', 'error');
            return redirect('/ruangan');
        }
    }


    public function hapus_ruangan($id)
    {
        try {
            $ruangan = Ruangan::find($id);
            $ruangan -> delete();
            Alert::toast('Ruangan berhasil dihapus!', 'success');

            return redirect('/konfig-ruangan');
        } catch (\Throwable $th) {
            Alert::toast('Kosongkan aset terlebih dahulu!', 'error');
            return redirect()->back();
        }

    }


    public function perbarui_ruangan(RuanganRequest $request, $id)
    {
        $request -> validated();

        try {
            $ruangan = Ruangan::find($id);
            $ruangan -> nama = $request -> ruangan;
            $ruangan -> update();

            Alert::toast('Kelas berhasil diubah!', 'success');
            return redirect('/konfig-ruangan');
        } catch (\Throwable $th) {
            Alert::toast('Kelas gagal diubah!', 'error');
            return redirect('/konfig-ruangan');
        }
    }


    public function multiple_delete(Request $request)
    {
        $id = $request->ids;
        Gudang::whereIn('id', explode(",",$id))->delete();
        return response()->json(['status'=>true,'message'=>"Category deleted successfully."]);
    }


}
