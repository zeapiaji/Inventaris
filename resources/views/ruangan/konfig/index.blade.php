@extends('layouts.app')
@include('footer')
@include('ruangan.konfig.script')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Konfigurasi <strong>Ruangan</strong></h1>
        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch">
                    <div class="me-auto p-2 d-grip gap-2"><input type="text" id="searchbar"
                            class="p-2 bd-highlight form-control align-baseline"
                            placeholder="barang, jumlah, status, kode..."></div>
                    <div class="p-2 d-grip gap-2"><a href="/tambah-ruangan"
                            class="btn btn-lg btn-info align-middle">Tambah Ruangan</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped my-0">
                    <thead>
                        <tr>
                            <th class="d-sm-table-cell text-muted text-center">Cek</th>
                            <th class="d-xl-table-cell">No</th>
                            <th class="d-xl-table-cell">Ruangan</th>
                            <th class="d-xl-table-cell">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangan as $item)
                        <tr>
                            <td class="border-end text-center"><input type="checkbox" class="checkbox"
                                    data-id="{{$item -> id}}"></td>
                            <td>{{$no++}}</td>
                            <td class=" d-xl-table-cell">{{$item -> nama}}</td>
                            <td class=" d-md-table-cell">
                                <a href="/edit-ruangan/{{$item -> id}}" class="btn btn-sm btn-info">Edit</a>
                                <a href="/hapus-ruangan/{{$item -> id}}" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card flex-fill">
            <div class="card-header">
                <div class="d-flex">
                    <div class="me-auto p-2 align-self-start"><input type="checkbox" id="check_all"><label
                            for="check_all" class="ms-1 align-self-start">Cek semua</label></div>
                    <div class="p-2 bd-highlight"><button type="button" class="btn btn-danger delete-all"
                            data-url="">Hapus yang dipilih</button></div>
                </div>
            </div>
        </div>
    </div>
</main>
@yield('footer')
@yield('script')

@endsection
