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
    <strong>REPORT Detail Penjualan Produk {{$nama_produk->nama_produk}} Dari Tanggal {{$tanggal_awal}}/{{$tanggal_akhir}}</strong><br>
    <strong></strong>
</div>
<table>
    <thead>
    <tr>
            <th>No</th>
            <th width="25">Nama Lengkap</th>
            <th width="25">Nama Toko</th>
            <th width="25">Nama Pembeli</th>
            <th width="25">Nama Produk</th>
            <th width="25">Jenis Produk</th>
            <th width="25">Tanggal Order</th>
            <th width="25">Tanggal Kirim</th>
            <th width="25">Tanggal Selesai</th>


    </tr>
    </thead>
    <tbody>
    @foreach($detail as $key => $item)
        <tr>
            <td style="text-align: center">{{ ++$key }}</td>
            <td>{{$item->nama_lengkap}}</td>
            <td>{{$item->nama_toko}}</td>
            <td>{{$item->nama_pembeli}}</td>
            <td>{{$item->nama_produk}}</td>
            <td>{{$item->jenis_produk}}</td>
            <td>{{$item->tgl_order}}</td>
            <td>{{$item->tgl_kirim}}</td>
            <td>{{$item->tgl_selesai}}</td>


        </tr>
    @endforeach
    </tbody>
</table>


