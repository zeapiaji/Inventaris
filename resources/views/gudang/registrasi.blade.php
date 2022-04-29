@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Registrasi Aset <strong>Gudang</strong></h1>

        <div class="card flex-fill p-5">
            <form action="/unggah" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_brg" class="form-control @error('nama_brg') is-invalid @enderror"
                            id="nama-barang" value="{{ old('nama_brg') }}">
                        @error('nama_brg')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            id="jumlah" value="{{ old('jumlah') }}" min="0" oninput="minusIgnore()">
                        @error('jumlah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kode-brg" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror"
                            id="kode-brg" maxlength="5" value="{{ old('kode_brg') }}">
                        @error('kode_brg')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                type="radio" id="gridRadios1" value="1">
                            <label class="form-check-label" for="gridRadios1">
                                Baru
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                type="radio" id="gridRadios2" value="2">
                            <label class="form-check-label" for="gridRadios2">
                                Layak Pakai
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                type="radio" id="gridRadios3" value="3">
                            <label class="form-check-label" for="gridRadios3">
                                Rusak Ringan
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                type="radio" id="gridRadios4" value="4">
                            <label class="form-check-label" for="gridRadios4">
                                Rusak
                            </label>
                        </div>
                        @error('status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>

    </div>
</main>

@yield('footer')

@endsection
