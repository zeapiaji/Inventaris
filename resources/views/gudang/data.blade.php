@foreach ($gudang as $item)
<tr>
    <td class="border-end text-center"><input type="checkbox" class="checkbox" data-id="{{$item -> id}}"></td>
    <td class="text-center">{{$no++}}</td>
    <td class="">{{$item -> barang -> nama}}</td>
    <td class="">{{$item -> total}}</td>
    <td>
        <span class="badge {{$item->status->id === 1 ? 'bg-info' : ''}}
            {{$item->status->id === 2 ? 'bg-success' : ''}}
            {{$item->status->id === 3 ? 'bg-warning' : ''}}
            {{$item->status->id === 4 ? 'bg-danger' : ''}}">
            {{$item->status->nama}}
        </span>
    </td>
    <td class="">{{$item -> barang -> kode}}</td>
    <td class="text-center">
        <a href="#" class="btn btn-sm btn-info edit" data-id="{{$item -> id}}" data-barang="{{$item -> barang -> nama}}"
            data-total="{{$item->total}}" data-status="{{$item -> status -> nama}}"
            data-kode="{{$item -> barang -> kode}}">Edit</a>
        <a href="#" class="btn btn-sm btn-danger delete" data-id="{{$item -> id}}">Hapus</a>
    </td>
</tr>
@endforeach

