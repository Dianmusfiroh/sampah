<form action="{{ route($modul . '.update', $target->id_target) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Target Waktu*</label>
        <div class="col-lg-4">
            <select name="bulan" id="bulan" class="form-control col-md-9">
                <option value="{{$target->bulan}}" selected>{{$target->bulan}} </option>
                <option value="januari">Januari</option>
                <option value="februari">Februari</option>
                <option value="maret">Maret</option>
                <option value="april">April</option>
                <option value="mei">Mei</option>
                <option value="juni">Juni</option>
                <option value="juli">Juli</option>
                <option value="agustus">Agustus</option>
                <option value="september">September</option>
                <option value="november">November</option>
                <option value="desember">Desember</option>

            </select>
        </div>
        <div class="col-lg-4">
            <select name="tahun" id="tahun" class="form-control col-md-9">
                <option value="{{$target->tahun}}" selected>{{$target->tahun}}</option>
                @foreach (range(2020,date('Y')) as $item)
                <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{--  <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Target Pengguna*</label>
        <div class="col-lg-9">
            <input type="number" name="pengguna" class="form-control" placeholder="{{$target->pengguna}}" value="{{$target->pengguna}}"/>
        </div>
    </div>  --}}
    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Target Pendaftaran*</label>
        <div class="col-lg-9">
            <input type="number" name="pendaftaran" class="form-control" placeholder="{{$target->pendaftaran}}" value="{{$target->pendaftaran}}" />
        </div>
    </div>
    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Target Transaksi*</label>
        <div class="col-lg-9">
            <input type="number" name="transaksi" class="form-control" placeholder="{{$target->transaksi}}" value="{{$target->transaksi}}"/>
        </div>
    </div>
    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Target Nominal*</label>
        <div class="col-lg-9">
            <input type="number" name="nominal" class="form-control" placeholder="{{$target->nominal}}" value="{{$target->nominal}}" />
        </div>
    </div>
    <div class="mb-3">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
</form>

<script>
    var exampleModal = document.getElementById('exampleModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget
        var recipient = button.getAttribute('data-bs-whatever')
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalTitle.textContent = 'Ubah Kategori '
        {{-- modalBodyInput.value = recipient --}}
    })
</script>
