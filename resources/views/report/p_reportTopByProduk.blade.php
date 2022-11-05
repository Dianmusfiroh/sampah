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
    <strong>REPORT Top Seles By Produk Dari Tanggal {{$tanggal_awal}} / {{$tanggal_akhir}}</strong><br>
    <strong></strong>
</div>
<table>
    <thead>
    <tr>
            <th>No</th>
            <th width="25">Nama Produk</th>
            <th  width="30">Nama Toko</th>
            <th width="30">No Hp</th>
            <th width="30">Link Toko</th>
            <th width="20">Email</th>
            <th width="20">Alamat Toko</th>
            <th width="20">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($topProduk as $key => $item)
        <tr>
            <td style="text-align: center">{{ ++$key }}</td>
            <td>{{$item->nama_produk}}</td>
            <td>{{$item->nama_toko}}</td>
            <td> @if (preg_match("/08/", substr("$item->no_hp_toko",0,2)))
                {{substr_replace("$item->no_hp_toko","62",0,1)}}
                @else
                {{$item->no_hp_toko}}
                @endif
            </td>
            <td>
                @if ($item->permalink != null)
                https://wbslink.id/{{Str::slug($item->permalink)}}
                @else
                https://wbslink.id/{{Str::slug($item->nama_toko)}}
                @endif
            </td>
            <td>{{$item->email_toko}}</td>
            <td>{{$item->alamat_toko}}</td>
            <td>{{$item->total}}</td>
        </tr>
    @endforeach
    </tbody>
</table>


