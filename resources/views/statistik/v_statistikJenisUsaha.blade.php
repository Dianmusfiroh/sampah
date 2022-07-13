<h1>{{ $label }}</h1>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Total Jenis Usaha </h5>
                <canvas id="myChart3" height="150"></canvas>
            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.9.1/underscore-min.js" ></script>
<script>
    var namaKU = [@php echo $namaKU    @endphp];
    var chrtTotal = [@php echo $chrtTotal    @endphp];
    if ($('#myChart3').length) {
        var ctx = document.getElementById("myChart3");
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: namaKU,
                datasets: [{
                    label: 'Statistik Ketegori Bisnis',
                    tension: 0.3,
                    fill: true,
                    backgroundColor: 'rgba(44, 120, 220, 0.2)',
                    borderColor: 'rgba(44, 120, 220)',
                    data: chrtTotal
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
