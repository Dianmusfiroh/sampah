<style>
    table{
        width: 100%;
    }
    th {
        width: 40%;
    }
 body{
     font-size:11pt;
 }
 .header{
     text-align: center;
 }
 .page_break { page-break-before: always; }
</style>
<div class="header">
    <strong>REKAPITULASI MEMBER TIDAK AKTIF</strong><br>
    <strong></strong>
</div>
<table>
    <thead>
    <tr>
            <th>No</th>
            <th width="25">Nama</th>
            <th  width="30">Nama Toko</th>
            <th width="30">No Wa</th>
            <th width="30">Link Toko</th>
            <th width="20">Tanggal Aktif</th>
            <th width="20">Tanggal Expired</th>
            <th width="20">Alamat</th>
            <th width="25">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($userExp as $key => $item)
        <tr>
            <td style="text-align: center">{{ ++$key }}</td>
            <td>{{$item->nama_lengkap}}</td>
            <td>{{$item->nama_toko}}</td>
            <td> @if (preg_match("/08/", $item->no_hp))
                {{substr_replace("$item->no_hp","62",0,1)}}
            @endif
            </td>
            <td>
                @if ($item->permalink != null)
                https://wbslink.id/{{Str::slug($item->permalink)}}
                @else
                https://wbslink.id/{{Str::slug($item->nama_toko)}}
                @endif
            </td>
            {{--  <td>wbslink.id/{{Str::slug($item->nama_toko)}}</td>  --}}
            <td>{{$item->is_created}}</td>
            <td>{{$item->tgl_expired}}</td>
            <td>{{$item->alamat}}</td>
            <td>{{$item->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

