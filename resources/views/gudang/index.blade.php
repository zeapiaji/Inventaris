@extends('layouts.app')
@include('footer')
@include('gudang.script')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Aset <strong>Gudang</strong></h1>
        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch bd-highlight">
                    <div class="me-auto p-2 bd-highlight"><input type="text" id="searchbar"
                        class="p-2 bd-highlight form-control align-baseline" placeholder="barang, jumlah, status, kode..."></div>
                    <div class="p-2 bd-highlight"><button type="button" id="add" data-bs-toggle="modal"
                            data-bs-target="#addnew" class="btn btn-lg btn-info align-middle">Registrasi Aset</button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped my-0">
                    <thead>
                        <tr>
                            <th class="d-xl-table-cell text-muted text-center">Cek</th>
                            <th class="d-xl-table-cell text-center">No</th>
                            <th class="d-xl-table-cell">Nama Barang</th>
                            <th class="d-xl-table-cell">Jumlah</th>
                            <th class="d-xl-table-cell">Status</th>
                            <th class="d-md-table-cell">Kode Barang</th>
                            <th class="d-md-table-cell text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="aset">
                        {{-- Data --}}
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card flex-fill">
            <div class="card-header">
                <div class="d-flex">
                    <div class="me-auto p-2 align-self-start"><input type="checkbox" id="check_all"><label for="check_all" class="ms-1 align-self-start">Cek semua</label></div>
                    <div class="p-2 bd-highlight"><button type="button" class="btn btn-danger delete-all" data-url="">Hapus yang dipilih</button></div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('gudang.modal')
@yield('footer')
@yield('script')
@endsection
