<?php

namespace App\Http\Controllers;

use App\Models\Gudang;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SoftDelete extends Controller
{
    public function pulihkan(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request -> id;
                Gudang::withTrashed()
                        -> where('id', $id)
                        -> restore();

                return response()->json(['status' => true, 'message'=>'Aset berhasil dipulihkan!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message'=>'Aset gagal dipulihkan!']);
        }

    }


    public function multi_recovery(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request->ids;
                Gudang::onlyTrashed()
                        ->whereIn('id', explode(",",$id))
                        ->restore();

                return response()->json(['status' => true, 'message'=>'Aset berhasil dipulihkan!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message'=>'Aset gagal dipulihkan!']);
        }
    }


    public function pulihkan_semua()
    {
        try {
            Gudang::onlyTrashed()
                    ->restore();

            Alert::toast('Semua aset berhasil dipulihkan!', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            Alert::toast('Semua aset gagal dipulihkan!', 'error');
            return redirect()->back();
        }
    }


    public function hapus(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request -> id;
                Gudang::withTrashed()
                        -> where('id', $id)
                        -> delete();
                return response()->json(['status' => true, 'message'=>'Aset berhasil dihapus!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message'=>'Aset gagal dihapus!']);
        }
    }


    public function hapus_permanen(Request $request)
    {
        try {
            if ($request->ajax()){
                $id = $request -> id;
                Gudang::withTrashed()
                        -> where('id', $id)
                        -> forceDelete();

                return response()->json(['status' => true, 'message'=>'Aset berhasil dihapus!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message'=>'Aset gagal dihapus!']);
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

    public function sampah_hapus_multi(Request $request)
    {
        try {
            $id = $request->ids;
            Gudang::onlyTrashed()
                    ->whereIn('id', explode(",",$id))
                    ->forceDelete();

            return response()->json(['status'=>true,'message'=>"Aset berhasil dihapus!"]);
        } catch (\Throwable $th) {
            return response()->json(['status' => true, 'message'=>'Aset gagal dihapus!']);
        }
    }
}
