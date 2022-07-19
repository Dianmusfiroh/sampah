<h1>{{ $label }}</h1>
Comming Soon...
{{--  <div class="card mb-4">
    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <div class="table-responsive">
                <table class="table align-middle table-nowrap mb-0" id="myTable">
                    <thead class="table-light">
                        <tr>
                            <th class="align-middle"  style="width: 4%;">No</th>
                            <th class="align-middle"  scope="col">Nama Toko</th>
                            <th class="align-middle"  scope="col">Nama Lengkap</th>
                            <th class="align-middle"  scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- table-responsive end// -->
    </div>
</div>  --}}
{{--  @include('script.delete')  --}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

