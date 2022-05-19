@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <div class="flex-fill">
            <div class="d-flex">
                <div class="me-auto"><h1 class="h3 mb-3">Aset <strong>Ruangan</strong> </h1></div>

            </div>
        </div>

        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch bd-highlight">
                    <div class="me-auto p-2 bd-highlight"><h5 class="card-title mb-0">Ruangan</h5></div>
                    <div class="p-2 bd-highlight"><a href="/konfig-ruangan" class="btn btn-info">Konfigurasi Ruangan</a></div>
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
                    <a href="/ruangan/{{$item -> id}}" class="text-decoration-none">
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
