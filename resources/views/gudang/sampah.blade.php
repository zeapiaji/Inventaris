@extends('layouts.app-core')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Sampah <strong>Gudang</strong></h1>
        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch bd-highlight">
                    <div class="me-auto p-2 bd-highlight"><input type="text" id="searchbar" class="p-2 bd-highlight form-control align-baseline" placeholder="cari disini.."></div>
                    <div class="p-2 bd-highlight"><a href="/gudang/sampah/pulihkan-semua" class="btn btn-info align-middle">Kembalikan Semua</a></div>
                    <div class="p-2 bd-highlight"><a href="/gudang/sampah/hapus-permanen-semua" class="btn btn-danger align-middle">Hapus Permanen Semua</a></div>
                  </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped my-0">
                    <thead>
                        <tr>
                            <th class="d-none d-xl-table-cell">No</th>
                            <th class="d-none d-xl-table-cell">Nama Barang</th>
                            <th class="d-none d-xl-table-cell">Jumlah</th>
                            <th class="d-none d-xl-table-cell">Status</th>
                            <th class="d-none d-md-table-cell">Kode Barang</th>
                            <th class="d-none d-md-table-cell">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="aset">
                        <div class="card">
                            <div class="card-header">
                            </div>
                        </div>
                        @foreach ($gudang as $item)
                            <tr>
                                <td>{{$no++}}</td>
                                <td class="d-none d-xl-table-cell">{{$item -> barang -> nama}}</td>
                                <td class="d-none d-xl-table-cell">{{$item -> total}}</td>
                                <td>
                                    <span class="badge {{$item->status->id === 1 ? 'bg-info' : ''}}
                                                       {{$item->status->id === 2 ? 'bg-success' : ''}}
                                                       {{$item->status->id === 3 ? 'bg-warning' : ''}}
                                                       {{$item->status->id === 4 ? 'bg-danger' : ''}}">
                                                       {{$item->status->nama}}
                                    </span>
                                </td>
                                <td class="d-none d-md-table-cell">{{$item -> barang -> kode}}</td>
                                <td class="d-none d-md-table-cell">
                                    <a href="/gudang/sampah/pulihkan/{{$item -> id}}" class="btn btn-sm btn-info">Pulihkan</a>
                                    <a href="/gudang/sampah/hapus-permanen/{{$item -> id}}" class="btn btn-sm btn-danger">Hapus Permanen</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<script type="text/javascript">
    function deleteConfirmation(id) {
        swal.fire({
            title: "Hapus Aset?",
            icon: 'question',
            text: "Harap pastikan kemudia konfirmasi!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Hapus Aset",
            cancelButtonText: "Batal",
            reverseButtons: !0
        }).then(function (e) {

            if (e.value === true) {
                let token = $('meta[name="csrf-token"]').attr('content');
                let _url = '/aset/gudang/hapus-aset/${id}';

                $.ajax({
                    type: 'POST',
                    url: _url,
                    data: {_token: token},
                    success: function (resp) {
                        if (resp.success) {
                            swal.fire("Done!", resp.message, "success");
                            location.reload();
                        } else {
                            swal.fire("Error!", 'Sumething went wrong.', "error");
                        }
                    },
                    error: function (resp) {
                        swal.fire("Error!", 'Sumething went wrong.', "error");
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
</script>

@yield('footer')

@endsection
