<div class="content-header">
    <div>
        <h1>{{ $label }}</h1>
    </div>
    <div>
        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#myModal"><i class="material-icons md-add"> </i>Tambah</button>
    </div>
</div>
<div class="card mb-4">
    <!-- card-header end// -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th >No</th>
                        <th >Kategori Bisnis</th>
                        <th  class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $key => $item   )
                        <tr>
                            <td >{{  ++$key }}</td>
                            <td >{{ $item->kategori_bisnis }}</td>
                            <td class="text-center">
                                <a href="{{ route($modul.'.edit', $item->id_kategori_bisnis) }}" title="{{ $item->kategori_bisnis }}" class="btn btn-sm font-sm rounded btn-brand btn-modal"><i class="material-icons md-edit"></i> Edit</a>

                                {{--  <a data-toggle="modal" data-target="#myModalEdit" class="btn btn-sm font-sm rounded btn-brand"
                                    type="submit"> <i class="material-icons md-edit"></i> Edit </a>  --}}
                                    {{--  <a href="{{ route( $modul.'.edit', $item->id_kategori_bisnis) }}" class="btn btn-sm font-sm rounded btn-brand"
                                        type="submit"> <i class="material-icons md-edit"></i> Edit </a>  --}}

                                {{--  <a href="{{ route('kategori.show', $item->id_ketgori_bisnis) }}" class="btn btn-success btn-sm"
                                    type="submit"><i class="fas fa-fw fa-edit"></i> Detail</a>  --}}
                                <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id_kategori_bisnis}})"
                                    data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="material-icons md-delete"></i>
                                    Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- table-responsive.// -->
    </div>
    </div>
</div>
<!-- card-body end// -->
</div>
{{--  --------modal Tabah -----  --}}
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            {{--  <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>  --}}
            <h4 class="modal-title">Tambah Kategori</h4>
            <button type="button" class="btn-close " data-dismiss="modal"></button>

        </div>
        <div class="modal-body">
            <form action="{{ route($modul.'.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <label class="col-lg-3 col-form-label">Nama Kategori Bisnis*</label>
                    <div class="col-lg-9">
                        <input type="text" name="kategori_bisnis" class="form-control" placeholder="Tulis Nama Kategori Bisnis" />
                    </div>
                    <!-- col.// -->
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-primary " type="submit">Simpan</button>
        </form>

        </div>
        </div>
    </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="modalFee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5>Ubah Kategori Bisnis  </h5>
        <h5 class="modal-title" ></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modal-body">

        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </div>
</div>
</div>

@include('script.delete')
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
{{--  <script type="text/javascript" src="DataTables/datatables.min.js"></script>  --}}
<script>
    $("#myTable").DataTable({
                    "autoWidth": true,
                    "responsive": true
                });
</script>
<script>
    $('body').on('click', '.btn-modal', function (event) {
        event.preventDefault();
        var me = $(this),
            url = me.attr('href'),
            title = me.attr('title');
        $('#modal-title').text(title);
        $.ajax({
            url: url,
            dataType: 'html',
            success: function (response) {
                $('#modal-body').html(response);
            }
        });
        $('#modalFee').modal('show');
    });

</script>



