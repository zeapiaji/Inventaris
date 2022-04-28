@extends('layouts.app-core')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tambah <strong>Kelas</strong></h1>

        <div class="card flex-fill p-4">
            <form action="/tambah-kelas/unggah" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Nama Kelas</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_kelas"
                            class="form-control @error('kelas') is-invalid @enderror" id="kelas">
                        @error('kelas')
                        <div class="invalid-feedback"> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>

    </div>
</main>

@yield('footer')

@endsection
