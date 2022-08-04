<h1>{{ $label }}</h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card mb-6">
            {{--  <div class="card-header">
                <h4>Shipping</h4>
            </div>  --}}
            <div class="card-body">
                {{--  <form action="">  --}}
                <form action="{{ route('storeAkun') }}" method="POST">
                @csrf
                @method('POST')
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Start</label>
                                <input type="date" name="tanggal_awal" placeholder="inch" class="form-control" id="date" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">End</label>
                                <input type="date" name="tanggal_akhir" placeholder="inch" class="form-control" id="date" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4 ">
                                <button type="submit" class="btn btn-md btn-primary end-text">Print</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- card end// -->
    </div>
    <div class="col-lg-3">
        <div class="card mb-4">

            <div class="card-body">
                <div class="row gx-2">
                <a href="{{ route('cetakAktif') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Download Member Aktif</a>
                    <div class="mb-4">
                        <label for="product_name" class="form-label"></label>
                        <a href="{{ route('cetakNonAktif') }}" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Download Member Expired</a>
                    </div>
                </div>
                <!-- row.// -->
            </div>
        </div>
        <!-- card end// -->
    </div>
</div>
<!-- card-body end// -->
</div>
@include('script.delete')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
        $(function() {
        $('date').change(function() {
            console.log('date');
        })
        })
</script>

<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });
</script>

