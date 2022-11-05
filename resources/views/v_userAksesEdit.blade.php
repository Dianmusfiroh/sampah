
<form action="{{ route($modul.'.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Username*</label>
        <div class="col-lg-9">
            <input type="text" name="name" class="form-control" value="{{$user->name}}"/>
        </div>
    </div>
    <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Email*</label>
        <div class="col-lg-9">
            <input type="email" name="email" class="form-control" value="{{$user->email}}" />
        </div>
    </div>
    {{--  <div class="row mb-4">
        <label class="col-lg-3 col-form-label">Password*</label>
        <div class="col-lg-9">
            <input type="password" name="password" class="form-control" value="{{$user->password}}" />
        </div>
    </div>  --}}
    <div class="mb-3">
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </form>

    <script>
        var exampleModal = document.getElementById('exampleModal')
exampleModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget
    var recipient = button.getAttribute('data-bs-whatever')
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')

    modalTitle.textContent = 'Ubah Kategori '
    {{--  modalBodyInput.value = recipient  --}}
})
    </script>
