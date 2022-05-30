<h1>{{ $label }}</h1>
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Revenue Base on Area</h5>
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
    (function($) {
        "use strict";

        /*Sale statistics Chart*/
        if ($('#myChart3').length) {
            var ctx = document.getElementById("myChart3");
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["900", "1200", "1400", "1600"],
                    datasets: [{
                            label: "Indonesia",
                            backgroundColor: "#5897fb",
                            barThickness: 10,
                            data: [233, 321, 783, 900]
                        },
                        {
                            label: "Europe",
                            backgroundColor: "#7bcf86",
                            barThickness: 10,
                            data: [408, 547, 675, 734]
                        },
                        {
                            label: "Asian",
                            backgroundColor: "#ff9076",
                            barThickness: 10,
                            data: [208, 447, 575, 634]
                        },
                        {
                            label: "Africa",
                            backgroundColor: "#d595e5",
                            barThickness: 10,
                            data: [123, 345, 122, 302]
                        },
                    ]
                },
                options: {
                indexAxis: 'y',
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
})(jQuery);

</script>
