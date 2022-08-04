<div class="content-header">
    <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i>Kembali </a>
</div>
<h1>{{ $label }}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Toko</th>
                        <th  width="50%">Nama Lengkap</th>
                        {{--  <th>Tanggal Expired</th>  --}}
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Total Transaksi</th>
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- table-responsive.// -->
    </div>
    </div>
</div>
<!-- card-body end// -->
</div>
@include('script.delete')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

