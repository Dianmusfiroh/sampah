<style>
    table{
        width: 100%;
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
    <strong>REKAPITULASI USER TIDAK AKTIF</strong><br>
    <strong></strong>
</div>
<table class="invoice-table" border="1" id="fee-table">
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
            <td>{{++$value}}</td>
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

</table>

