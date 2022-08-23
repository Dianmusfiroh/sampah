<h1>{{ $label }}</h1>

<div class="row">
    <div class="col-lg-7">

        <div class="card mb-4">
            <article class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="align-middle" scope="col">No</th>
                                    <th class="align-middle" scope="col">Deskripsi</th>
                                    <th class="align-middle" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

            </article>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">

                        <form action="{{ route('sendNotif')}}" method="POST" enctype="multipart/form-data">
                            {{--  <form action="{{ route($modul.'.store')}}" method="POST" enctype="multipart/form-data">  --}}
                            @csrf
                            @method('POST')
                            <div class="mb-4">
                                <label for="product_name" class="form-label">Judul Notifikasi</label>
                                <input type="text" placeholder="Type here" class="form-control" id="title" name="title" />
                            </div>
                            {{--  <div class="mb-4">
                                <label for="product_name" class="form-label">type</label>
                                <select class="form-select tipe" >
                                    <option selected>Type</option>
                                    <option>App</option>
                                    <option>Link</option>

                                </select>
                            </div>  --}}
                            <div class="mb-4" id="form-type">
                                <input type="text" name="link" placeholder="Type here" class="form-control" />

                            </div>
                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea placeholder="Type here" name="desc" class="form-control " id="field"></textarea>
                            </div>

                            <div class="d-grid">
                                <button class="btn btn-primary">kirim</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

{{--  @include('script.delete')  --}}
{{--  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  --}}
<script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="DataTables/datatables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js"></script>
<script>
    $("#myTable").DataTable({
                    "autoWidth": false,
                    "responsive": true
                });

</script>
<script>

    $("#field").emojioneArea({
        pickerPosition: "bottom"
    });
    $(document).ready(function(){
        $("select.tipe").change(function(){
            var selectedType = $(this).children("option:selected").val();
            if(selectedType == "Link"){
                $('#form-type').show(450);
            }
            if(selectedType == "App" || selectedType == "Type"){
                $('#form-type').hide(450);
            }

        });
    });


    var firebaseConfig = {
        apiKey: "AIzaSyCzxsb3f6qaAZeV6g5ILHycAuiRDGOjO1k",
        authDomain: "notiftes-a4953.firebaseapp.com",
        projectId: "notiftes-a4953",
        storageBucket: "notiftes-a4953.appspot.com",
        messagingSenderId: "969175479697",
        appId: "1:969175479697:web:af24f60476d360a76a9630"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    {{--  function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("sendNotif") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
    }  --}}

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
            click_action: payload.notification.click_action,

        };
        new Notification(noteTitle, noteOptions);
    });


</script>

