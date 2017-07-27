@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Edit Health Measure Entry</h2>

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
                  <form action="{{ action('HealthMonitorController@update', $measure[0]->id)}}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">

				  {!! csrf_field() !!}
				  {{ method_field('PATCH') }}

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Health Measure</label>
                      <div class="col-sm-6">
                        <select name="healthmeasure" id="type" class="form-control" required>

                          		<option value="weight" <?php if($measure[0]->measure == 'weight') echo 'selected'; ?> >Weight</option>
								<option value="height" <?php if($measure[0]->measure == 'height') echo 'selected'; ?>>Height</option>
								<option value="calories intake" <?php if($measure[0]->measure == 'calories intake') echo 'selected'; ?>>Calories Intake</option>
								<option value="calories burnt" <?php if($measure[0]->measure == 'calories burnt') echo 'selected'; ?>>Calories burnt</option>


                        </select>
                      </div>
                    </div>

					<div class="form-group">
                      <label class="col-sm-3 control-label">Value</label>
                      <div class="col-sm-6">
                        <input name="value" id="name" type="text" class="form-control" required value="{{ $measure[0]->value }}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label"> Date </label>
                      <div class="col-md-3 col-xs-7">
                        <div data-min-view="2" data-date-format="dd/mm/yyyy" class="input-group date datetimepicker">
                          <input name="date" id="expiry" size="16" type="text" value="{{ $measure[0]->date }}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
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
