<nav>
    <ul class="menu-aside">
        <li class="menu-item @if(Request::segment(1) == 'beranda'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('beranda')}}">
                <i class="icon material-icons md-home"></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('akun') }}">
                <i class="icon material-icons  md-format_list_bulleted"></i>
                <span class="text">List User</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('report') }}">
                <i class="icon material-icons  md-report"></i>
                <span class="text">Report</span>
            </a>
        </li>
        <li class="menu-item @if(Request::segment(1) == 'user'): {{'active'}} @endif">
            <a class="menu-link" href="{{ url('statistik') }}">
                <i class="icon material-icons  md-pie_chart"></i>
                <span class="text">Statistik</span>
            </a>
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
