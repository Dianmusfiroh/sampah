<h1>{{ $label }}</h1>
<div class="row">
    <div class="col-lg-9">
        <div class="card mb-6">
            <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Start</label>
                                <input type="date" name="tanggal_awal" placeholder="inch" class="form-control" id="start" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="product_name" class="form-label">End</label>
                                <input type="date" name="tanggal_akhir" placeholder="inch" class="form-control" id="end" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4 ">
                                <a type="submit" id="print" onclick="print()" class="btn btn-md btn-primary end-text">Print</a>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
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
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script>
    function print() {
        let start = $("#start").val();
        let end = $("#end").val();
        $.ajax({
            url: "{{ route('userFilter') }}",
            data: {"start":start,
                    "end": end},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (data) {
                var a = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                console.log(data);
                a.href = url;
                a.download = 'Daftar Akun expire dari tanggal '+start+' / '+end+'.xlsx';
                document.body.append(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            }
        });
     };
</script>


