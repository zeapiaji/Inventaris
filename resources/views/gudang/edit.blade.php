@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Edit Aset <strong>Gudang</strong></h1>

        <div class="card flex-fill p-5">
            <form action="/perbarui-aset-gudang/{{$data->id}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                      <input type="text" name="nama_brg" class="form-control @error('nama_brg') is-invalid @enderror" id="nama-barang" value="{{ $data -> barang -> nama }}" >
                      @error('nama_brg')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                      <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" value="{{ $data -> total }}" min="0" oninput="minusIgnore()">
                      @error('jumlah')
                      <div class="invalid-feedback">{{$message}}</div>
                      @enderror
                    </div>
                  </div>

                  <div class="row mb-3">
                      <label for="kode-brg" class="col-sm-2 col-form-label">Kode Barang</label>
                      <div class="col-sm-10">
                        <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror" id="kode-brg" maxlength="5" value="{{ $data -> barang -> kode }}" >
                          @error('kode_brg')
                          <div class="invalid-feedback">{{$message}}</div>
                          @enderror
                      </div>
                    </div>
                  <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                      <div class="col-sm-10">
                          <div class="form-check">
                          <input class="form-check-input @error('status') is-invalid @enderror" name="status" type="radio" id="gridRadios1" value="1" {{$data -> status -> id === 1? 'checked' : ''}}>
                          <label class="form-check-label" for="gridRadios1">
                              Baru
                          </label>
                          </div>
                          <div class="form-check">
                          <input class="form-check-input @error('status') is-invalid @enderror" name="status" type="radio" id="gridRadios2" value="2" {{$data -> status -> id === 2? 'checked' : ''}}>
                          <label class="form-check-label" for="gridRadios2">
                              Layak Pakai
                          </label>
                          </div>
                          <div class="form-check">
                          <input class="form-check-input @error('status') is-invalid @enderror" name="status" type="radio" id="gridRadios3" value="3" {{$data -> status -> id === 3? 'checked' : ''}}>
                          <label class="form-check-label" for="gridRadios3">
                              Rusak Ringan
                          </label>
                          </div>
                          <div class="form-check">
                          <input class="form-check-input @error('status') is-invalid @enderror" name="status" type="radio" id="gridRadios4" value="4" {{$data -> status -> id === 4? 'checked' : ''}}>
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
</main>

@yield('footer')

@endsection
