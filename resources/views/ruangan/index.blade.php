@extends('layouts.app')
@include('footer')
@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Aset Ruangan <strong>{{$identitas -> nama}}</strong></h1>

        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8 col-xxl-8 d-flex">
                <div class="card flex-fill p-2">
                    <div class="card-header">
                        <div class="d-flex stretch">
                            <div class="me-auto p-2"><input type="text" id="searchbar"
                                class="p-2 form-control align-baseline" placeholder="barang, total, status...">
                            </div>
                            <div class="p-2"><a href="ambil/{{$identitas -> id}}" class="btn rounded-sm btn-lg btn-info">Ambil dari gudang</a></div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped my-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="d-xl-table-cell">Nama Barang</th>
                                    <th class="d-xl-table-cell">Total Aset</th>
                                    <th class="d-xl-table-cell">Status</th>
                                    <th class="d-md-table-cell">Akomodasi Barang</th>
                                </tr>
                            </thead>
                            <tbody id="aset">
                                @foreach ($data as $item)
                                <tr>
                                    <td class="d-xl-table-cell">{{$no++}}</td>
                                    <td class="d-xl-table-cell">{{$item -> barang ->nama}}</td>
                                    <td class="d-xl-table-cell">{{$item -> total }}</td>
                                    <td class="d-xl-table-cell">
                                        <span class="badge {{$item->status->id === 1 ? 'bg-info' : ''}}
                                            {{$item->status->id === 2 ? 'bg-success' : ''}}
                                            {{$item->status->id === 3 ? 'bg-warning' : ''}}
                                            {{$item->status->id === 4 ? 'bg-danger' : ''}}">
                                            {{$item->status->nama}}
                                        </span>
                                    </td>
                                    <td class=" d-xl-table-cell">
                                        <a href="/aset/ruangan/detail/akomodasi-aset/{{$item -> id}}/barang/{{$item -> barang -> id}}"
                                            class="btn btn-sm btn-success">Tambah</a>
                                        <a href="/aset/ruangan/detail/kembalikan-aset/{{$item -> id}}/barang/{{$item -> barang -> id}}"
                                            data-id="{{$item -> barang -> id}}"
                                            class="btn btn-sm btn-warning kembalikan">Kembalikan</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4 col-xxl-4 d-flex">
                <div class="card flex-fill p-2">
                    <div class="card-header">
                        <div class="d-flex stretch bd-highlight">
                            <div class="me-auto p-2 bd-highlight">
                                <h5 class="card-title mb-0">Stok Barang</h5>
                            </div>
                            <div class="p-2 bd-highlight"><input type="text" id="searchbar-gudang"
                                    class="p-2 bd-highlight form-control align-baseline" placeholder="barang, total, status...">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped my-0">
                            <thead>
                                <tr>
                                    <th class=" d-xl-table-cell">Nama Barang</th>
                                    <th class=" d-xl-table-cell">Status</th>
                                    <th class=" d-xl-table-cell">Stok</th>
                                </tr>
                            </thead>
                            <tbody id="aset-gudang">
                                @foreach ($gudang as $item)
                                <tr>
                                    <td class="d-xl-table-cell">{{$item -> barang -> nama}}</td>
                                    <td class="d-xl-table-cell">{{$item -> status -> nama}}</td>
                                    <td class="d-xl-table-cell">{{$item -> total}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="my-3">

                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@yield('footer')

@endsection
