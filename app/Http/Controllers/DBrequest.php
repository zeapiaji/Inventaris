<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Barang;
use App\Models\Gudang;
use App\Models\Akomodasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\KelasFormRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\GudangStorePostRequest;
use App\Http\Requests\KelasJumlahFormRequest;
use App\Http\Requests\TambahKelasFormRequest;
use App\Http\Requests\KelasKembalikanFormRequest;
use Laravel\Ui\Presets\React;

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
    public function akomodasi_aset($id, $id_brg, KelasJumlahFormRequest $request)
    {
        $request ->validated();

        try {
            $gudang          = Gudang::where('id', $id_brg)->first();
            $prosesGudang    = $gudang -> total - $request->jumlah;
            $gudang -> total = $prosesGudang;

            $akomodasi       = Akomodasi::where('id', $id)->first();
            $prosesAkomodasi = $akomodasi -> total  + $request->jumlah;
            $akomodasi -> total = $prosesAkomodasi;

            $gudang -> save();
            $akomodasi -> save();

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil ditambahkan!', 'success');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' gagal ditambahkan!', 'success');
            return redirect()->back();
        }

    }


    public function kembalikan_aset($id, $id_brg, KelasJumlahFormRequest $request)
    {
        $request ->validated();

        try {
            $gudang          = Gudang::where('id', $id_brg)->first();
            $prosesGudang    = $gudang -> total + $request->jumlah;
            $gudang -> total = $prosesGudang;

            $akomodasi       = Akomodasi::where('id', $id)->first();
            $prosesAkomodasi = $akomodasi -> total  - $request->jumlah;
            $akomodasi -> total = $prosesAkomodasi;

            $gudang -> save();
            $akomodasi -> save();

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' berhasil dikembalikan!', 'success');
            return redirect()-> back();
        } catch (\Throwable $th) {

            Alert::toast($request -> jumlah . ' '. $gudang -> barang -> nama. ' gagal dikembalikan!', 'error');
            return redirect()-> back();
        }

    }


    public function ambil_aset(KelasFormRequest $request, $id)
    {
        $request -> validated();

        try {
            $gudang = Gudang::where('barang_id', $request -> nama_brg)
                        ->where('status_id', $request -> status)
                        ->first();
            $prosesGudang         = $gudang -> total  - $request -> jumlah;
            $gudang -> total = $prosesGudang;
            $gudang -> save();


            Akomodasi::create([
                'total'     => $request -> jumlah,
                'barang_id' => $request -> nama_brg,
                'kelas_id'  => $id,
                'status_id' => $request -> status,
            ]);

            Alert::toast($request -> nama_brg . 'berhasil diambil!', 'success');
            return redirect()->back();

        } catch (\Throwable $th) {
            Alert::toast($request -> nama_brg . 'gagal diambil!', 'error');
            return redirect()->back();
        }

    }


    public function hapus_aset_gudang(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request -> id;
                $gudang = Gudang::find($id) -> delete();

                return response($gudang);
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




    /*
    |--------------------------------------------------------------------------
    | Soft Delete
    |--------------------------------------------------------------------------
    */
    public function pulihkan($id)
    {
        try {
            Gudang::withTrashed()
                    -> where('id', $id)
                    -> restore();

            Alert::toast('Aset berhasil dipulihkan!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::toast('Aset gagal dipulihkan!', 'error');
            return redirect()->back();
        }

    }


    public function pulihkan_semua()
    {
        try {
            Gudang::withTrashed()
                ->restore();

            Alert::toast('Semua data berhasil dipulihkan!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::toast('Semua data gagal dipulihkan!', 'error');
            return redirect()->back();
        }
    }


    public function hapus($id)
    {
        try {
            Gudang::withTrashed()
                    ->where('id', $id)
                    ->forceDelete();

            Alert::toast('Aset berhasil dihapus!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::toast('Aset gagal dihapus!', 'error');
            return redirect()->back();
        }
    }


    public function hapus_semua()
    {
        try {
            Gudang::onlyTrashed()
                    ->forceDelete();

            Alert::toast('Semua aset berhasil dihapus!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::toast('Semua aset gagal dihapus!', 'error');
            return redirect()->back();
        }
    }

}
