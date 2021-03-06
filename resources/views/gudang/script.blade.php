@section('script')
<script type="text/javascript">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function showData() {
            $.get("{{ URL::to('data') }}", function (data) {
                $('#aset').empty().html(data);
            });
        }


        showData();


        $('#addForm').on('submit', function (e) {
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: form,
                dataType: 'json',
                success: function () {
                    $('#addnew').modal('hide');
                    $('#addForm')[0].reset();
                    toastStore();
                    showData();
                }
            });
        });


        $(document).on('click', '.edit', function (event) {
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


        $('#editForm').on('submit', function (e) {
            e.preventDefault();
            var form = $(this).serialize();
            var url = $(this).attr('action');
            $.post(url, form, function (data) {
                $('#editmodal').modal('hide');
                toastUpdate();
                showData();
            })
        });


        $(document).on('click', '.delete', function (event) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "*aset yang dipilih akan dipindahkan ke sampah!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yakin',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.post("{{ URL::to('hapus') }}", {
                        id: id
                    }, function () {
                        toastDelete();
                        showData();
                    })
                }
            })
        });

        // Pagination


        // CheckBox
        $('#check_all').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".checkbox").prop('checked', true);
            } else {
                $(".checkbox").prop('checked', false);
            }
        });


        $('.checkbox').on('click', function () {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#check_all').prop('checked', true);
            } else {
                $('#check_all').prop('checked', false);
            }
        });


        $('.delete-all').on('click', function (e) {
            var idsArr = [];
            $(".checkbox:checked").each(function () {
                idsArr.push($(this).attr('data-id'));
            });
            if (idsArr.length <= 0) {
                toastNull()
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "*aset yang dipilih akan dipindahkan ke sampah!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yakin',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        var strIds = idsArr.join(",");
                        $.ajax({
                            url: "{{ URL::to('multiple-delete') }}",
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            },
                            data: 'ids=' + strIds,
                            success: function (data) {
                                if (data['status'] == true) {
                                    $(".checkbox:checked").each(function () {
                                        $(this).parents("tr").remove();
                                    });
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                                showData();
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                        toastDelete();
                    }
                })
            }
        });


        // Alert
        function toastStore() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Aset berhasil diregistrasi!'
            })
        }


        function toastUpdate() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Aset berhasil diperbarui!'
            })
        }


        function toastDelete() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Aset berhasil dihapus!'
            })
        }

        function toastNull() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                width: 300,
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'error',
                title: 'Pilih setidaknya satu aset!'
            })
        }
    });

</script>
@endsection
