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

        showData();

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
                    showData();
                }
            });
        });

        $(document).on('click', '.edit', function(event){
            event.preventDefault();
            var id = $(this).data('id');
            var barang = $(this).data('barang');
            var total = $(this).data('total');
            var kode = $(this).data('kode');
            var status = $(this).data('status');
            $('#editmodal').modal('show');
            $('#barang').val(barang);
            $('#total').val(total);
            $('#kode').val(kode);
            $('#status').val(status);
            $('#memid').val(id);
        });

        // $(document).on('click', '.delete', function(event){
        //     event.preventDefault();
        //     var id = $(this).data('id');
        //     $('#deletemodal').modal('show');
        //     $('#deletemember').val(id);
        // });

        $('#editForm').on('submit', function(e){
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url,form,function(data){
                $('#editmodal').modal('hide');
                showData();
            })
        });

        // $('#deletemember').click(function(){
        //     var id = $(this).val();
        //     $.post("{{ URL::to('delete') }}",{id:id}, function(){
        //         $('#deletemodal').modal('hide');
        //         showMember();
        //     })
        // });

    });

    function showData(){
        $.get("{{ URL::to('data') }}", function(data){
            $('#aset').empty().html(data);
        })
    }

</script>
@endsection
