@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Log Health Measure</h2>

            <!-- <span style="float:right; padding-top:10px;">
            	<a href="{{ action('GoalController@create') }}" class="btn btn-space btn-primary btn-lg"> Add Activity &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
            </span> -->



            @include('partials.quote')
	</div>
</div>

<div class="row">

    <div class="col-sm-12">
      <div class="panel panel-default panel-table be-custom-panel">

        <div class="panel-body">

          @include('partials.errors')


<div class="row">
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading"></div>
                <div class="panel-body">
                  <form action="{{ action('HealthMonitorController@store')}}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {!! csrf_field() !!}

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Health Measure</label>
                      <div class="col-sm-6">
                        <select name="healthmeasure" id="type" class="form-control" required>

                          		<option value="weight">Weight</option>
								<option value="height">Height</option>
								<option value="calories intake">Calories Intake</option>
								<option value="calories burnt">Calories burnt</option>


                        </select>
                      </div>
                    </div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Value</label>
                      <div class="col-sm-6">
                        <input name="value" id="name" type="text" class="form-control" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label"> Date </label>
                      <div class="col-md-3 col-xs-7">
                        <div data-min-view="2" data-date-format="dd/mm/yyyy" class="input-group date datetimepicker">
                          <input name="date" id="expiry" size="16" type="text" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                        </div>
                      </div>
                    </div>


                    <div class="form-group">
                      <label class="col-sm-3 control-label"></label>
                      <div class="col-sm-6">
                        <button type="submit" class="btn btn-space btn-primary">Submit</button>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
</div>




@stop
