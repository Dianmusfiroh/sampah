
<body>
    <div id="app">
        <main class="py-4">
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
                                <button type="submit" name="" class="btn btn-outline-light" data-dismiss="modal"
                                    onclick="formSubmit()">Yes, Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
    @include('sweetalert::alert')
</body>
</html>
