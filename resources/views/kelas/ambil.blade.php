@extends('layouts.app-core')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Ambil Aset dari <strong>Gudang</strong></h1>

        <div class="row">
            <div class="col-xl-8 col-xxl-8 col-sm-12 col-md-12 col-lg-12 d-flex">
                <div class="card flex-fill p-4">
                    <form action="/kelas/ambil-aset/{{$data->id}}" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <label for="nama-brg" class="col-sm-3 col-form-label">Nama Barang</label>
                            <div class="col-sm-9">
                                <select class="form-select @error('nama_brg') is-invalid @enderror" name="nama_brg">
                                    <option class="borded-bottom" selected disabled>Pilih Barang</option>
                                    @foreach ($gudang as $item)
                                    <option value="{{$item -> id}}">
                                            {{$item -> barang -> nama}}
                                    </option>
                                    @endforeach
                                </select>
                                @error('nama_brg')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="jumlah" class="col-sm-3 col-form-label">Jumlah</label>
                            <div class="col-sm-9">
                                <input type="number" name="jumlah"
                                    class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                    value="{{ old('jumlah') }}" min="0" oninput="minusIgnore()">
                                @error('jumlah')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-3 pt-0">Status</legend>
                            <div class="col-sm-9">
                                <div class="form-check">
                                    <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                        type="radio" id="gridRadios1" value="1">
                                    <label class="form-check-label" for="gridRadios1">
                                        Baru
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                        type="radio" id="gridRadios2" value="2">
                                    <label class="form-check-label" for="gridRadios2">
                                        Layak Pakai
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                        type="radio" id="gridRadios3" value="3">
                                    <label class="form-check-label" for="gridRadios3">
                                        Rusak Ringan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('status') is-invalid @enderror" name="status"
                                        type="radio" id="gridRadios4" value="4">
                                    <label class="form-check-label" for="gridRadios4">
                                        Rusak
                                    </label>
                                </div>
                                @error('status')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </fieldset>
                        
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-4 col-sm-12 col-md-12 col-lg-12 d-flex">
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
                                    <th class=" d-xl-table-cell">Status</th>
                                    <th class=" d-xl-table-cell">Stok</th>
                                </tr>
                            </thead>
                            <tbody id="aset">
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

    </div>
</main>

@yield('footer')

@endsection

<script>
    import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
    Swal.fire({
        icon: 'warning',
        text: 'Do you want to delete this?',
        showCancelButton: true,
        confirmButtonText: 'Delete',
        confirmButtonColor: '#e3342f',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>
