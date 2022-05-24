@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <div class="d-flex">
            <h1 class="h3 mb-3 me-auto">Edit Ruangan <strong>{{$ruangan -> nama}}</strong></h1>
            <a href="/konfig-ruangan" class="fs-5">Kembali</a>
        </div>
        <div class="card flex-fill p-4">
            <form action="/perbarui-ruangan/{{$ruangan -> id}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Ruangan</label>
                    <div class="col-sm-10">
                        <input type="text" name="ruangan" class="form-control @error('ruangan') is-invalid @enderror"
                        value="{{$ruangan -> nama}}">
                        @error('ruangan')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
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
