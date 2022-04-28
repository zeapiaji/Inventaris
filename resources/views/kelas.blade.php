@extends('layouts.app-core')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Aset <strong>Kelas</strong> </h1>


        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch bd-highlight">
                    <div class="me-auto p-2 bd-highlight"><h5 class="card-title mb-0">Kelas</h5></div>
                    <div class="p-2 bd-highlight"><a href="/tambah-kelas" class="btn btn-info">Tambah Kelas</a></div>
                    <div class="p-2 bd-highlight">
                        <input type="text" id="searchbar" class="p-2 bd-highlight form-control align-baseline" placeholder="cari disini..">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($data as $item)
            <div class="col-xxl-3 col-xl-3 col-md-5 col-sm-3">
                <div class="btn btn-success card">
                    <a href="/kelas/{{$item -> id}}" class="text-decoration-none">
                        <div class="card-body">
                            <h1 class="mt-1 mb-3">{{$item -> nama}}</h1>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach


        </div>
    </div>

</main>

@yield('footer')

@endsection
