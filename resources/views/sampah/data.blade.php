@foreach ($gudang as $item)
<tr>
    <td><input type="checkbox" class="checkbox" data-id="{{$item -> id}}"></td>
    <td>{{$no++}}</td>
    <td class=" d-xl-table-cell">{{$item -> barang -> nama}}</td>
    <td class=" d-xl-table-cell">{{$item -> total}}</td>
    <td>
        <span class="badge {{$item->status->id === 1 ? 'bg-info' : ''}}
            {{$item->status->id === 2 ? 'bg-success' : ''}}
            {{$item->status->id === 3 ? 'bg-warning' : ''}}
            {{$item->status->id === 4 ? 'bg-danger' : ''}}">
            {{$item->status->nama}}
        </span>
    </td>
    <td class=" d-md-table-cell">{{$item -> barang -> kode}}</td>
    <td class=" d-md-table-cell">
        <a href="#" class="btn btn-sm btn-info pulihkan" data-id="{{$item -> id}}">Pulihkan</a>
        <a href="#" class="btn btn-sm btn-warning hapus" data-id="{{$item -> id }}">Hapus Permanen</a>
    </td>
</tr>
@endforeach
