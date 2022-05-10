@section('script')
<script type="text/javascript">
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function showData() {
            $.get("{{ URL::to('data-sampah') }}", function (data) {
                $('#sampah').empty().html(data);
            });
        }


        showData();


        $(document).on('click', '.pulihkan', function (event) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "*aset akan dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.post("{{ URL::to('pulihkan') }}", {
                        id: id
                    }, function () {
                        toastPulihkan();
                        showData();
                    })
                }
            })
        });


        $(document).on('click', '.hapus', function (event) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "*aset akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.post("{{ URL::to('hapus-permanen') }}", {
                        id: id
                    }, function () {
                        toastDelete();
                        showData();
                    })
                }
            })
        });


        $(document).on('click', '.pulihkan-semua', function (event) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "*Semua aset akan dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ URL::to('pulihkan-semua') }}", {}, function () {
                        toastPulihkan();
                        showData();
                    })
                }
            })
        });


        $(document).on('click', '.hapus-semua', function (event) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "*Semua aset akan dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("{{ URL::to('hapus-semua') }}", {}, function () {
                        toastDelete();
                        showData();
                    })
                }
            })
        });


        $('.multi-recovery').on('click', function (e) {
            var idsArr = [];
            $(".checkbox:checked").each(function () {
                idsArr.push($(this).attr('data-id'));
            });
            if (idsArr.length <= 0) {
                toastNull()
            } else {
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "*aset yang dipilih akan dipulihkan!",
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
                            url: "{{ URL::to('multi-recovery') }}",
                            type: 'POST',
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
                                    alert('Whoops ada yang salah!!');
                                }
                                showData();
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });
                        toastPulihkan();
                    }
                })
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
                    text: "*aset yang dipilih akan dihapus secara permanen!",
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
                            url: "{{ URL::to('sampah_hapus_multi') }}",
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
                                    alert('Whoops ada yang salah!!');
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

        // Alert
        function toastPulihkan() {
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
                title: 'Aset berhasil dipulihkan!'
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
