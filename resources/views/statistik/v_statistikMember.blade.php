<h1>{{ $label }}</h1>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Total Pengguna Berdasarkan Provinsi</h5>
                <canvas id="myChart3" height="150"></canvas>
            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
<script>

    {{--  var userExp = [@php echo $chart @endphp];
    var userActive = [@php echo $chartUser @endphp];
    console.log(userActive);  --}}



        var chrtMember = [@php echo $chrtMember @endphp];
        var prov = [@php echo $prov @endphp];
        let text = "";
        {{--  for (let i = 0; i < prov.length; i++) {
        text += prov[i] ;
        }
        console.log(prov);
        let province ;
        if (prov == '0'){
            province = 'tidak memilih';
        } else if(prov == '1'){
            province = 'Bali';
        }else {
        };
        console.log(province);  --}}

{{--
        if(prov = '0'){
            province =  "Tidak Memilih";

        } else if(prov = '1'){
            province =  "Bali";

        } else if(prov = '2'){
            province =  "Bangka Belitung";

        } else if(prov = '3'){
            province =  "Banten";

        } else if(prov = '4'){
            province =  "Bengkulu";

        } else if(prov = '5' ){
            province =  "DI Yogyakarta";

        } else if(prov = '6' ){
            province =  "DKI Jakarta";

        } else if(prov = '7' ){
            province =  "Gorontalo";

        } else if(prov = '8' ){
            province =  "Jambi";

        } else if(prov = '9'){
            province =  "Jawa Barat";

        } else if(prov = '10' ){
            province =  "Jawa Tengah";

        } else if(prov = '11' ){
            province =  "Jawa Timur";

        } else if(prov = '12' ){
            province =  "Kalimantan Barat";

        } else if(prov = '13' ){
            province =  "Kalimantan Selatan";

        } else if(prov = '14' ){
            province =  "Kalimantan Tengah";

        } else if(prov = '15'){
            province =  "Kalimantan Timur";

        } else if(prov = '16' ){
            province =  "Kalimantan Utara";

        } else if(prov = '17' ){
            province =  "Kepulauan Riau";

        } else if(prov = '18'){
            province =  "Lampung";

        } else if(prov = '19'){
            province =  "Maluku";

        } else if(prov = '20' ){
            province =  "Maluku Utara";

        } else if(prov = '21'){
            province =  "NAD";

        } else if(prov = '22' ){
            province =  "NTB";

        } else if(prov = '23' ){
            province =  "NTT";

        } else if(prov = '24' ){
            province =  "Papua";

        } else if(prov = '25' ){
            province =  "Papua Barat";

        } else if(prov = '26' ){
            province =  "Riau";

        } else if(prov = '27'){
            province =  "Sulawesi Barat";

        } else if(prov = '28' ){
            province =  "Sulawesi Selatan";

        } else if(prov = '29'){
            province =  "Sulawesi Tengah";

        } else  if(prov = '30'){
            province =  "Sulawesi Tenggara";

        } else  if(prov = '31'){
            province =  "Sulawesi Utara";

        } else  if(prov = '32'){
            province =  "Sumatra Barat";

        } else if(prov = '33'){
            province =  "Sumatra Selatan";

        } else if(prov = '34'){
            province =  "Sumatra Utara";

        } else{

        };  --}}
        /*Sale statistics Chart*/
        if ($('#myChart3').length) {
            var ctx = document.getElementById("myChart3");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: prov,
                    datasets: [{
                            backgroundColor: "#5897fb",
                            barThickness: 10,
                            data: chrtMember
                        },
                    ]
                },
                options: {
               // indexAxis: 'y',
                    plugins: {
                        legend: {
                            labels: {
                                usePointStyle: true,
                            },
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

</script>
