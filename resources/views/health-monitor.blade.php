@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Health Monitor</h2>



			<span style="float:right; padding-top:10px;">
              <a href="{{ action('HealthMonitorController@create') }}" class="btn btn-space btn-primary btn-lg"> Log Health Measure &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
            </span>

			<span style="float:right; padding-top:10px;">
              <a href="{{ action('HealthMonitorController@table') }}" class="btn btn-space btn-primary btn-lg"> Tabulated View &nbsp;<i class="icon icon-left mdi mdi-table-large"></i></a>
            </span>

            @include('partials.quote')
	</div>
</div>

<div class="row">

    <div class="col-sm-12">
      <div class="panel panel-default panel-table be-custom-panel">

        <div class="panel-body">

          @include('partials.errors')

          <div class="row">

			  <?php $i = 0; $all_measures= array_keys($data); foreach($data as $measure){   ?>

          	<div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">{{ ucfirst($all_measures[$i]) }}</span>
                          </div>
                          <div class="widget-chart-container">


                            <canvas id="myChart<?php echo $i; ?>" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>

			<? $i++; } ?>


          </div>



          </div>
      </div>
    </div>
</div>




@stop

@section('footer')

    <script src="{{ URL::asset('assets/lib/chartjs/Chart.min.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
      	//initialize the javascript
      	App.init();



      });
    </script>

<?php $i = 0; $all_measures= array_keys($data); foreach($data as $measure){ ?>
    <script>

var ctx = document.getElementById("myChart<?php echo $i ?>");

var data = {
    labels: [<?php print implode(",", $measure['timeSeries']); ?>],
    datasets: [
        {
            label: "{{ ucfirst($all_measures[$i]) }}",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "#4285f4",
            borderColor: "#4285f4",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "#4285f4",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "#4285f4",
            pointHoverBorderColor: "#4285f4",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: [<?php print implode(",", $measure['valueSeries']); ?>],
            spanGaps: false,
        }
    ]
};

var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>

<? $i++; } ?>


@stop
