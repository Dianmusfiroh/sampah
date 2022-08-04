<h1>{{ $label }}</h1>

<div class="row">
    <div class="col-xl-10 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Sale statistics</h5>
                <canvas id="Chart" height="120px"></canvas>
            </article>
        </div>
    </div>
    <div class="col-xl-2 col-lg-12">
        <div class="card mb-4">
            <article class="card-body">
                <h5 class="card-title">Revenue Base on Area</h5>
                {{--  <canvas id="myChart2" height="217"></canvas>  --}}
            </article>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>

<script>
    {{--  var userExp = [@php echo $chart @endphp];
    var userActive = [@php echo $chartUser @endphp];
    console.log(userActive);  --}}
    (function($) {
        "use strict";

        /*Sale statistics Chart*/
        if ($('#Chart').length) {
        var ctx = document.getElementById('Chart').getContext('2d');

        var chart = new Chart(ctx, {
        type: "line",

        data: {
        labels: ['Jan', 'Feb', 'Mar','Apr','Mei','Jun','Jul','Ags','Sep','Oct','Nov','Des'],
        datasets: [{
            label: 'Sales',
            tension: 0.3,
            fill: true,
            backgroundColor: 'rgba(44, 120, 220, 0.2)',
            borderColor: 'rgba(44, 120, 220)',
            data: [18, 17, 4, 3, 2, 20, 25, 31, 25, 22, 20, 9]

        },

        ]
        },
            options: {
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                        },
                    }
                }
            }
    });
}
})(jQuery);

</script>




