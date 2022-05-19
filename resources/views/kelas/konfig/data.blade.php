@foreach ($kelas as $item)
<tr>
    <td class="border-end text-center"><input type="checkbox" class="checkbox" data-id="{{$item -> id}}"></td>
    <td>{{$no++}}</td>
    <td class=" d-xl-table-cell">{{$item -> nama}}</td>
    <td class=" d-md-table-cell">
        <a href="#" class="btn btn-sm btn-info edit" data-id="{{$item -> id}}" data-kelas="{{$item -> nama}}">Edit</a>
        <a href="#" class="btn btn-sm btn-warning hapus" data-id="{{$item -> id }}">Hapus</a>
    </td>
</tr>
@endforeach
