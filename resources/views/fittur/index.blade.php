<div class="content-header">
    <div>
        <h1>{{ $label }}</h1>
    </div>
    <div>
        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#myModal"><i class="material-icons md-add"> </i>Tambah</button>
    </div>
</div>
<div class="card mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th>Nama Fitur</th>
                        <th>Harga</th>
                        <th width="20%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Fittur as $key => $item)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$item->fittur}}</td>
                        <td>@currency($item->harga)</td>
                        <td class="text-center">
                            <a href="{{ route($modul.'.edit', $item->id_fittur) }}" title="{{ $item->fittur }}" class="btn btn-sm font-sm rounded btn-brand btn-modal"><i class="material-icons md-edit"></i> Edit</a>
                            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$item->id_fittur}})"
                                data-target="#DeleteModal" class="btn btn-sm btn-danger"><i class="material-icons md-delete"></i>
                                Delete</a>
                        </td>
                    </tr>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
{{--  modal tambah  --}}
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Tambah Fittur</h4>
            <button type="button" class="btn-close " data-dismiss="modal"></button>

        </div>
        <div class="modal-body">
            <form action="{{ route($modul.'.store') }}" method="POST">
                @csrf
                <div class="row mb-4">
                    <label class="col-lg-3 col-form-label">Nama Fittur*</label>
                    <div class="col-lg-9">
                        <input type="text" name="fittur" class="form-control" placeholder="Tulis Nama fittur" />
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-lg-3 col-form-label">Harga Fittur*</label>
                    <div class="col-lg-9">
                        <input type="number" name="harga" class="form-control" placeholder="Tulis Harga fittur" />
                    </div>
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
            <h5>Ubah Fittur  </h5>
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

<script>
    $("#myTable").DataTable({
                    "autoWidth": true,
                    "responsive": true
                });
</script>
<script>
    $('body').on('click', '.btn-modal', function (event){
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



