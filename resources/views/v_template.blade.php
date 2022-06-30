
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>WBSLINK ADMIN</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    {{--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">  --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{--  <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>  --}}

    {{--  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.22/datatables.min.css"/>  --}}


    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/imgs/theme/ICON LOGO.png')}}" />
    <!-- Template CSS -->
    <link href="{{ asset('backend/assets/css/main.css?v=1.0')}}" rel="stylesheet" type="text/css" />
    <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
    {{--  <link rel="stylesheet" type="text/css" href="{{asset('DataTables/datatables.css')}}"/>  --}}
</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="beranda" class="brand-wrap col-nav">
            <div>
                <img src="{{ asset('backend/assets/imgs/theme/Logo WBSLINK.png')}}" class="logo"  />
            </div>
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"><i
                        class="text-muted material-icons md-menu_open"></i></button>
            </div>
        </div>
            {{ view('v_menu') }}
        <!-- menu -->
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">

            <div class="col-search">
                <form class="searchform">
                </form>
            </div>
            <div class="col-nav">
            <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"><i class="material-icons md-apps"></i></button>

                <ul class="nav menu-aside">
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle"
                                src="{{asset('backend/assets/imgs/people/profile.png')}}" alt="User" />
                            </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item text-danger" href="logout"><i
                                    class="material-icons md-exit_to_app"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        <section class="content-main">
            <!-- body -->
            {{ view($view,$data) }}
            @yield('content')
            <div id="DeleteModal" class="modal fade" aria-hidden="true">
                <div class="modal-dialog ">
                    <!-- Modal content-->
                    <form action="" id="deleteForm" method="post">
                        <div class="modal-content bg-danger">
                            <div class="modal-header">
                                <h4 style="color: white" class="modal-title text-center">DELETE CONFIRMATION</h4>
                                <button type="button"  data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >x</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <p class="text-center" style="color: white">Are you sure want to delete this data ?</p>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cancel</button>
                                <button  type="submit" name="" class="btn btn-outline-light" data-dismiss="modal"
                                    onclick="formSubmit()">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    @include('sweetalert::alert')

        </section>
        <!-- content-main end// -->
        <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                    document.write(new Date().getFullYear());
                    </script>
                    ©, KLIK DIGITAL INDONESIA .
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">team Developers Klik Indonesia</div>
                </div>
            </div>
        </footer>
    </main>
    <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/vendors/select2.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/vendors/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js')}}"></script>
    <script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
    <!-- Main Script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('backend/assets/js/main.js?v=1.0')}}" type="text/javascript"></script>
    <script src="{{ asset('backend/assets/js/custom-chart.js')}}" type="text/javascript"></script>
</body>

</html>
