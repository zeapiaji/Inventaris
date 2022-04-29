@extends('layouts.app')
@include('footer')

@section('content')

<main class="content">
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Aset <strong>Gudang</strong></h1>
        <div class="card flex-fill p-2">
            <div class="card-header">
                <div class="d-flex stretch bd-highlight">
                    <div class="me-auto p-2 bd-highlight"><h5 class="card-title mb-0">Barang Baru/Cadangan</h5></div>
                    <div class="p-2 bd-highlight"><button type="button" id="add" data-bs-toggle="modal" data-bs-target="#addnew" class="btn btn-lg btn-info align-middle">Registrasi Aset</button></div>
                    <div class="p-2 bd-highlight"><input type="text" id="searchbar" class="p-2 bd-highlight form-control align-baseline" placeholder="cari disini.."></div>
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
                        {{-- @foreach ($data as $item)
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
                                    <a href="/gudang/sunting-aset/{{$item -> id}}" class="btn btn-sm btn-info">Edit</a>
                                    <a href="/gudang/hapus-aset/{{$item -> id}}" class="btn btn-sm btn-danger">Hapus</a>
                                </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

@yield('footer')

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        showMember();

        $('#addForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form,
                dataType: 'json',
                success: function(){
                    $('#addnew').modal('hide');
                    $('#addForm')[0].reset();
                    showMember();
                }
            });
        });

        $(document).on('click', '.edit', function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var firstname = $(this).data('first');
            var lastname = $(this).data('last');
            $('#editmodal').modal('show');
            $('#firstname').val(firstname);
            $('#lastname').val(lastname);
            $('#memid').val(id);
        });

        $(document).on('click', '.delete', function(event){
            event.preventDefault();
            var id = $(this).data('id');
            $('#deletemodal').modal('show');
            $('#deletemember').val(id);
        });

        $('#editForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,form,function(data){
                $('#editmodal').modal('hide');
                showMember();
            })
        });

        $('#deletemember').click(function(){
            var id = $(this).val();
            $.post("{{ URL::to('delete') }}",{id:id}, function(){
                $('#deletemodal').modal('hide');
                showMember();
            })
        });

    });

    function showMember(){
        $.get("{{ URL::to('gudang') }}", function(data){
            $('#memberBody').empty().html(data);
        })
    }

</script>
@endsection
