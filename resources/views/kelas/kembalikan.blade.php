@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Akomodasi <strong>{{$data -> barang -> nama}} {{$data -> kelas -> nama}}</strong></h1>

        <div class="row">
            <div class="col-xl-8 col-xxl-8">
                <div class="card flex-fill p-4">
                    <form action="/aset/kelas/detail/kembalikan/{{$data->id}}/barang/{{$barang}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="number" name="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" max="{{$maxData -> total}}"
                                    oninput="minusIgnore()">
                                @error('jumlah')
                                <div class="invalid-feedback"> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-4 d-flex">
                <div class="card flex-fill p-2">
                    <div class="card-header">
                        <div class="d-flex stretch bd-highlight">
                            <div class="me-auto p-2 bd-highlight">
                                <h5 class="card-title mb-0">Stok Barang</h5>
                            </div>
                            <div class="p-2 bd-highlight"><input type="text" id="searchbar"
                                    class="p-2 bd-highlight form-control align-baseline" placeholder="cari disini..">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-striped my-0">
                            <thead>
                                <tr>
                                    <th class=" d-xl-table-cell">Nama Barang</th>
                                    <th class=" d-xl-table-cell">Stok</th>
                                </tr>
                            </thead>
                            <tbody id="aset">
                                @foreach ($gudang as $item)
                                <tr>
                                    <td class="d-xl-table-cell">{{$item -> barang -> nama}}</td>
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

    </div>
</main>

@yield('footer')

@endsection
