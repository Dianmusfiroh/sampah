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
                        <th width="10">No</th>
                        <th>Nama Usaha</th>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>No hp</th>
                        <th>Expire</th>
                        <th>Aksi</th>
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

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
{{--  <script type="text/javascript" src="DataTables/datatables.min.js"></script>  --}}
<script>
    $(function(){
        var table = $('#myTable').DataTable({
            processing: true,
            language: {
                'processing':  `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...`
            },
            serverSide: true,
            ajax: "{{ route('akunTidakAktif') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama_toko',
                    name: 'nama_toko'
                },
                {
                    data: 'nama_lengkap',
                    name: 'nama_lengkap'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'no_hp',
                    name: 'no_hp'
                },
                {
                    data: 'getExp',
                    name: 'getExp'

                },
                {
                    name:'action',
                    data:'action'
                }

            ],
        });
    });
</script>

