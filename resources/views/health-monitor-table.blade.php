@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Health Monitor</h2>



			<span style="float:right; padding-top:10px;">
              <a href="{{ action('HealthMonitorController@create') }}" class="btn btn-space btn-primary btn-lg"> Log Health Measure &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
            </span>

			<span style="float:right; padding-top:10px;">
              <a href="{{ action('HealthMonitorController@index') }}" class="btn btn-space btn-primary btn-lg"> Graphical View &nbsp;<i class="icon icon-left mdi mdi-table-large"></i></a>
            </span>

            @include('partials.quote')
	</div>
</div>

<div class="row">

	<div class="col-sm-12">
      <div class="panel panel-default panel-table be-custom-panel">

        <div class="panel-body">

          @include('partials.errors')



          <div class="table-responsive noSwipe">
            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th style="width:25%;">Health Measure</th>
                  <th style="width:15%;">Value</th>
                  <th style="width:10%;">Date Logged</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($data as $measure)

                <tr>
                  <td class="cell-detail"><span>{{ $measure->measure }}</span></td>
                  <td class="cell-detail"> <span>{{ $measure->value }}</span></td>
                  <td class="cell-detail"><span>{{ $measure->date }}</span></td>

                  <td class="text-right">
                    <div class="btn-group btn-hspace">
                      <button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle">Manage <span class="icon-dropdown mdi mdi-chevron-down"></span></button>
                      <ul role="menu" class="dropdown-menu pull-right">
                        <!--<li><a href="{{action('HealthMonitorController@edit', $measure->id, $measure->measure)}}">Edit</a></li>-->
                        <li>
<form action="{{action('HealthMonitorController@cedit')}}" method="POST" style="display:inline-block;">
          {!! csrf_field() !!}
          

		  <input name="id" type="hidden" value="{{$measure->id}}">
		  <input name="measure" type="hidden" value="{{$measure->measure}}">

          <input type="submit" style="background: white;
    border: 0;
    padding: 5px 0 0 20px;" value="Edit">
        </form>


                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>

                @endforeach



              </tbody>
            </table>
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




@stop
