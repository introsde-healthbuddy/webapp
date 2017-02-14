@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Health Monitor</h2>

            <span style="float:right; padding-top:10px;">
            	
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
          	
          	<div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - Weight</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>

            <div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - Height</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart2" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>


          </div>

          <!--
           <div class="row">
          	
          	<div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - Blood Pressure</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart3" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>

            <div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - BMI</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart4" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>


          </div>


           <div class="row">
          	
          	<div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - Sleeping Hours</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart5" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>

            <div class="col-md-6">
                        <div class="widget">
                          <div class="widget-head">
                            <span class="title">Heath Measure History - Heart Rate</span>
                          </div>
                          <div class="widget-chart-container">
                            
                            
                            <canvas id="myChart6" style="width:100%; height:500px;" height="200"></canvas>
                          </div>
                        </div>
            </div>


          </div>!-->

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

    <script>

var ctx = document.getElementById("myChart");

var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [
        {
            label: "Weight (kg)",
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
            data: [80, 78, 79, 76, 74, 70, 71, 72, 72, 73, 71, 70],
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


 <script>

var ctx = document.getElementById("myChart2");

var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [
        {
            label: "Height (cm)",
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
            data: [177, 177, 177, 177, 177.5, 177.5, 177.5, 178, 178, 178, 178, 178],
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


 <script>

var ctx = document.getElementById("myChart3");

var data = {
    labels: [""],
    datasets: [
        {
            label: "Height (cm)",
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
            data: [177, 177, 177, 177, 177.5, 177.5, 177.5, 178, 178, 178, 178, 178],
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
@stop
