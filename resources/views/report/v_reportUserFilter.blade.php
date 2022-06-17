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
    <strong>REKAPITULASI MEMBER </strong><br>
    <strong></strong>
</div>
<table>
    <thead>
    <tr>
            <th>No</th>
            <th width="25">Nama</th>
            <th  width="30">Nama Toko</th>
            <th width="30">No Hp</th>
            <th width="30">Link Toko</th>
            <th width="20">Tanggal Aktif</th>
            <th width="20">Tanggal Expired</th>
            <th width="25">Email</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $key => $item)
        <tr>
            <td style="text-align: center">{{ ++$key }}</td>
            <td>{{$item->nama_lengkap}}</td>
            <td>{{$item->nama_toko}}</td>
            {{--  <td>{{$item->no_hp}}</td>  --}}
            <td> @if (preg_match("/08/", substr("$item->no_hp",0,2)))
                {{substr_replace("$item->no_hp","62",0,1)}}
                @else
                {{$item->no_hp}}
                @endif
            </td>
            <td>wbslink.id/{{Str::slug($item->nama_toko)}}</td>
            <td>{{$item->is_created}}</td>
            <td>{{$item->tgl_expired}}</td>
            <td>{{$item->email}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
{{--  <table class="invoice-table" border="1" id="fee-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Nama Toko</th>
            <th>No Hp</th>
            <th>Link Toko</th>
            <th>Tanggal Aktif</th>
            <th>Tanggal Expired</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $value => $item)

        <tr class="row-data">
            {{--  @dump($user);  --}}
            {{--  <td>{{++$value}}</td>
            <td>{{$item->nama_lengkap}}</td>
            <td>{{$item->nama_toko}}</td>
            <td>{{$item->no_hp}}</td>
            <td>wbslink.id/{{Str::slug($item->nama_toko)}}</td>
            <td>{{$item->is_created}}</td>
            <td>{{$item->tgl_expired}}</td>
            <td>{{$item->email}}</td>

        </tr>
    </tbody>
    @endforeach

</table>  --}}

