<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Akomodasi;
use Illuminate\Http\Request;
use App\Http\Requests\KelasFormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\KelasJumlahFormRequest;
use App\Http\Requests\TambahKelasFormRequest;

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

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Alert::success(session('success'));
            }

            if (session('error')) {
                Alert::error(session('error'));
            }

            return $next($request);
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Gudang
    |--------------------------------------------------------------------------
    */
    public function tambah_kelas_unggah(TambahKelasFormRequest $request)
    {
        $request -> validated();

        try {
            Kelas::create([
                'nama' => $request -> nama_kelas
            ]);

            Alert::toast('Kelas '. $request -> nama_kelas.' berhasil ditambahkan!', 'success');
            return redirect('/kelas');
        } catch (\Throwable $th) {
            Alert::toast('Kelas '. $request -> nama_kelas.' gagal ditambahkan!', 'error');
            return redirect('/kelas');
        }
    }


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
    | Kelas
    |--------------------------------------------------------------------------
    */
    public function akomodasi_aset(KelasJumlahFormRequest $request, $id, $id_brg)
    {
        $request -> validated();

        try {
            $gudang          = Gudang::where('id', $id_brg)->first();
            $prosesGudang    = $gudang -> total - $request->jumlah;
            $gudang -> total = $prosesGudang;

            $akomodasi       = Akomodasi::where('id', $id)->first();
            $prosesAkomodasi = $akomodasi -> total  + $request->jumlah;
            $akomodasi -> total = $prosesAkomodasi;

            $gudang -> save();
            $akomodasi -> save();

            $kelas = Akomodasi::where('id', $id)->first();
            $kelas = $kelas -> kelas -> id;

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil ditambahkan!', 'success');
            return redirect('/kelas/'.$kelas);

        } catch (\Throwable $th) {
            $kelas = Akomodasi::where('id', $id)->first();
            $kelas = $kelas -> kelas -> id;

            Alert::toast('Ada yang salah, silahkan coba lagi nanti!', 'error');
            return redirect('/kelas/'.$kelas);
        }

    }


    public function kembalikan_aset(KelasJumlahFormRequest $request, $id, $id_brg)
    {
        $request ->validated();

        try {
                $gudang          = Gudang::where('barang_id', $id_brg)->first();
                $prosesGudang    = $gudang -> total + $request->jumlah;
                $gudang -> total = $prosesGudang;

                $akomodasi       = Akomodasi::where('id', $id)->first();
                $prosesAkomodasi = $akomodasi -> total  - $request->jumlah;
                $akomodasi -> total = $prosesAkomodasi;
                $gudang -> save();
                $akomodasi -> save();

                $kelas = Akomodasi::where('id', $id)->first();
                $kelas = $kelas -> kelas -> id;

                Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil dikembalikan!', 'success');
                return redirect('/kelas/'.$kelas);
            // } catch (\Throwable $th) {
            //     Gudang::create([
            //         'total' => $request -> jumlah,
            //         'barang_id' => $id_brg,
            //         'status_id' => 1,
            //     ]);

            //     $gudang          = Gudang::where('barang_id', $id_brg)->first();
            //     $prosesGudang    = $gudang -> total + $request->jumlah;
            //     $gudang -> total = $prosesGudang;

            //     $akomodasi       = Akomodasi::where('id', $id)->first();
            //     $prosesAkomodasi = $akomodasi -> total  - $request->jumlah;
            //     $akomodasi -> total = $prosesAkomodasi;
            //     $gudang -> save();
            //     $akomodasi -> save();

            //     $kelas = Akomodasi::where('id', $id)->first();
            //     $kelas = $kelas -> kelas -> id;

            //     Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil dikembalikan!', 'success');
            //     return redirect('/kelas/'.$kelas);
            // }
        } catch (\Throwable $th) {
            $kelas = Akomodasi::where('id', $id)->first();
            $kelas = $kelas -> kelas -> id;

            Alert::toast('Ada yang salah, silahkan coba lagi nanti!', 'error');
            return redirect('/kelas/'.$kelas);
        }

    }


    public function ambil_aset(KelasFormRequest $request, $id)
    {
        $request -> validated();
        $gudang = Gudang::where('barang_id', $request -> nama_brg)
                    ->where('status_id', $request -> status)
                    ->first();
        // dd($gudang);
        $prosesGudang    = $gudang -> total - $request -> jumlah;
        $gudang -> total = $prosesGudang;
        $gudang -> save();

        Akomodasi::create([
            'total'     => $request -> jumlah,
            'barang_id' => $request -> nama_brg,
            'kelas_id'  => $id,
            'status_id' => $request -> status,
        ]);

        $kelas = Akomodasi::where('id', $id)->first();
        $kelas = $kelas -> kelas -> id;

        Alert::toast($gudang -> barang -> nama . ' berhasil diambil!', 'success');
        return redirect('/kelas/'.$kelas);
        try {

        } catch (\Throwable $th) {
            $kelas = Akomodasi::where('id', $id)->first();
            $kelas = $kelas -> kelas -> id;

            Alert::toast('Ada yang salah, silahkan coba lagi nanti!', 'error');
            return redirect('/kelas/'.$kelas);
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


    public function multiple_delete(Request $request)
    {
        $id = $request->ids;
        Gudang::whereIn('id', explode(",",$id))->delete();
        return response()->json(['status'=>true,'message'=>"Category deleted successfully."]);
    }


}
