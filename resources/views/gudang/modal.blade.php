<!-- Add Modal -->
<div class="modal" id="addnew" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bolder" id="myModalLabel">Registrasi Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger print-error-msg" style="display: none">
                    <ul>
                        {{-- Error Msg --}}
                    </ul>
                </div>

                <form action="{{ URL::to('unggah') }}" id="addForm">
                    <div class="row mb-3">
                        <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_brg" class="form-control" id="nama_brg" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="number" name="jumlah" class="form-control" id="jumlah" min="0"
                                oninput="minusIgnore()" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="kode-brg" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="kode_brg"
                                class="form-control" id="kode_brg" maxlength="5" required>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" name="status"
                                    type="radio" id="radio" value="1" required>
                                <label class="form-check-label" for="gridRadios1">
                                    Baru
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status"
                                    type="radio" id="radio" value="2" required>
                                <label class="form-check-label" for="gridRadios2">
                                    Layak Pakai
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status"
                                    type="radio" id="radio" value="3" required>
                                <label class="form-check-label" for="gridRadios3">
                                    Rusak Ringan
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="status"
                                    type="radio" id="radio" value="4" required>
                                <label class="form-check-label" for="gridRadios4">
                                    Rusak Berat
                                </label>
                            </div>
                        </div>
                    </fieldset>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal" id="editmodal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Edit Aset</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="alert alert-danger print-error-msg" style="display: none">
                    <ul>
                        {{-- Error Msg --}}
                    </ul>
                </div>

                <form action="{{ URL::to('perbarui') }}" id="editForm">
                    <input type="hidden" id="memid" name="id">
                    <div class="row mb-3">
                        <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_brg"
                                class="form-control" id="barang">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                        <div class="col-sm-10">
                            <input type="number" name="jumlah"
                                class="form-control @error('jumlah') is-invalid @enderror" id="total"
                                value="{{ old('jumlah') }}" min="0" oninput="minusIgnore()">
                            @error('jumlah')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="kode-brg" class="col-sm-2 col-form-label">Kode Barang</label>
                        <div class="col-sm-10">
                            <input type="text" name="kode_brg"
                                class="form-control @error('kode_brg') is-invalid @enderror" id="kode" maxlength="5"
                                value="{{ old('kode_brg') }}">
                            @error('kode_brg')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                        <div class="col-sm-10">
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success" id="update">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>
