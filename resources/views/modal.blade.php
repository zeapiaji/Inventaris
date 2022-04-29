<!-- Add Modal -->
<div class="modal" id="addnew" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Add New Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
              <form action="{{ URL::to('unggah') }}" id="addForm">
                <div class="row mb-3">
                    <label for="nama-barang" class="col-sm-2 col-form-label">Nama Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_brg" class="form-control @error('nama_brg') is-invalid @enderror"
                            id="nama-barang" value="{{ old('nama_brg') }}">
                        @error('nama_brg')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                    <div class="col-sm-10">
                        <input type="number" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                            id="jumlah" value="{{ old('jumlah') }}" min="0" oninput="minusIgnore()">
                        @error('jumlah')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="kode-brg" class="col-sm-2 col-form-label">Kode Barang</label>
                    <div class="col-sm-10">
                        <input type="text" name="kode_brg" class="form-control @error('kode_brg') is-invalid @enderror"
                            id="kode-brg" maxlength="5" value="{{ old('kode_brg') }}">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Edit Modal -->
  <div class="modal" id="editmodal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Edit Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
          <div class="modal-body">
              <form action="{{ URL::to('/perbarui') }}" id="editForm">
                  <input type="hidden" id="memid" name="id">
                  <div class="mb-3">
                      <label for="firstname">Nama Barang</label>
                      <input type="text" name="barang" id="barang" class="form-control">
                  </div>
                  <div class="mb-3">
                      <label for="lastname">Total</label>
                      <input type="number" name="total" id="total" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="lastname">Kode Barang</label>
                    <input type="text" name="kode" id="kode" class="form-control">
                </div>

                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" name="status1" type="radio" id="raido" value="1">
                        <label class="form-check-label" for="gridRadios1">
                            Baru
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" name="status2" type="radio" id="radio" value="2">
                        <label class="form-check-label" for="gridRadios2">
                            Layak Pakai
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" name="status3" type="radio" id="radio" value="3">
                        <label class="form-check-label" for="gridRadios3">
                            Rusak Ringan
                        </label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input @error('status') is-invalid @enderror" name="status4" type="radio" id="radio" value="4">
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
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success" id="update">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Delete Modal -->
  <div class="modal" id="deletemodal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Delete Member</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
              <h4 class="text-center">Are you sure you want to delete Member?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="deletemember" class="btn btn-danger">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
