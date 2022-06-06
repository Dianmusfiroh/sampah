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
                <a href="">Member Tidak perpanjang</a>
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
            </div>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('akun') }}">
                <i class="icon material-icons  md-admin_panel_settings"></i>
                <span class="text">Setting</span>
            </a>
        </li>
    </ul>
    <hr />
    <ul class="menu-aside">

    </ul>
    <br />
    <br />
</nav>
<?php
