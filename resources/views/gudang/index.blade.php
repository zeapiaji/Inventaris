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
                    <div class="me-auto p-2 bd-highlight"><button type="button" class="btn btn-danger delete-all" data-url="">Hapus yang dipilih</button></div>
                    <div class="p-2 bd-highlight"><button type="button" id="add" data-bs-toggle="modal"
                            data-bs-target="#addnew" class="btn btn-lg btn-info align-middle">Registrasi Aset</button>
                    </div>
                    <div class="p-2 bd-highlight"><input type="text" id="searchbar"
                            class="p-2 bd-highlight form-control align-baseline" placeholder="cari disini.."></div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-xl-table-cell"><input type="checkbox" id="check_all"></th>
                            <th class="d-none d-xl-table-cell">No</th>
                            <th class="d-none d-xl-table-cell">Nama Barang</th>
                            <th class="d-none d-xl-table-cell">Jumlah</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                            <th class="d-none d-md-table-cell">Kode Barang</th>
                            <th class="d-none d-md-table-cell">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="aset">
                        {{-- Data --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@yield('footer')
@yield('script')
@endsection
