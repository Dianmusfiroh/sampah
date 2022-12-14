<nav>
    <ul class="menu-aside">
        <li class="menu-item @if(Request::segment(1) == 'beranda'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('beranda')}}">
                <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif has-submenu">
            <a class="menu-link" href="{{ url('akun') }}">
                <i class="icon material-icons  md-supervised_user_circle"></i>
                <span class="text">User</span>
            </a>
            <div class="submenu">
                <a href="{{ url('akun') }}">List Member</a>
                <a href="{{ url('akunTidakAktif') }}">Member Tidak perpanjang</a>
                {{--  <a href="page-seller-detail.html">Laporan Member Aktif/Tidak</a>  --}}
            </div>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif has-submenu">
            <a class="menu-link" href="{{ url('report') }}">
                <i class="icon material-icons  md-report"></i>
                <span class="text">Report</span>
            </a>
            <div class="submenu">
                <a href="{{ url('report') }}">Produk/Penjualan Terbaik</a>
                <a href="{{url('reportAkun')}}">Laporan Member Aktif/Tidak</a>
            </div>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif has-submenu">
            <a class="menu-link" href="">
                <i class="icon material-icons  md-pie_chart"></i>
                <span class="text">Statistik</span>
            </a>
            <div class="submenu">
                <a href="{{ url('statistik') }}">Statistik Barang</a>
                <a href="{{ url('statistikMember') }}">Statistik Member</a>
                <a href="{{ url('statistikJenisUsaha') }}">Statistik Jenis Usaha</a>
                <a href="{{ url('statistikPengirim') }}">Statistik Jasa Pengirim</a>
            </div>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('logUser') }}">
                <i class="icon material-icons  md-local_activity"></i>
                <span class="text">Log Activity User</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('SendNotification') }}">
                <i class="icon material-icons  md-notification_important"></i>
                <span class="text">Kirim Notifikasi</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif has-submenu ">
            <a class="menu-link" href="{{ url('akun') }}">
                <i class="icon material-icons  md-admin_panel_settings"></i>
                <span class="text">Setting</span>
            </a>
            <div class="submenu">
                <a href="{{ url('kategori') }}">Tambah Kategori</a>
                <a href="{{ url('tutorial') }}">Tutorial </a>
                <a href="{{ url('fittur') }}">Fittur</a>
                <a href="{{ url('target') }}">Target</a>
            </div>

        </li>
        <hr />

        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif has-submenu ">
            <a class="dropdown-item text-danger" href="logout"><i
                class="material-icons md-exit_to_app"></i>Logout</a>
        </li>

    </ul>
    <ul class="menu-aside">

    </ul>
    <br />
    <br />
</nav>
<?php
