<h1>{{ $label }}</h1>

<div class="card mb-4">

    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Toko</th>
                        <th  width="50%">Nama Lengkap</th>
                        <th>Email</th>
                        <th>No Hp</th>
                        <th>Expire</th>
                        {{--  <th>Total Transaksi</th>  --}}
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(function () {



        const get_expire = async (user_id,product_id) =>{
            let obj;
            const res =  await fetch (`{{getenv('WBS_ENPOINT')}}?_key={{getenv('WBS_KEY')}}&user_id=${user_id}&product_id=${product_id}`);
            obj = await res.text();
            console.log(obj)
            return obj
        }


        var table = $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {name: 'nama_toko' },
                {data: 'nama_lengkap', name: 'nama_lengkap'},
                {data: 'email', name: 'email'},
                {data: 'no_hp', name: 'no_hp'},
                {name: 'expire'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                {
                    targets: 1,
                    data: function( row, type, val, meta){
                        return `<a href="{{url('akun')}}/${row.id_user}">${row.nama_toko}</a>`
                    }
                },
                {
                    targets:5,
                    data : function ( row, type, val, meta){
                        return get_expire(row.user_id,row.produk_id);
                    }
                }
            ]


        });

    });
  </script>





