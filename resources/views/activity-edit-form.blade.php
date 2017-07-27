@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Activities</h2>

            <span style="float:right; padding-top:10px;">
            	<a href="{{ action('GoalController@create') }}" class="btn btn-space btn-primary btn-lg"> Add Activity &nbsp;<i class="icon icon-left mdi mdi-plus"></i></a>
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
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading"></div>
                <div class="panel-body">
                  <form action="{{ action('ActivityController@update', $activity->id)}}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {!! csrf_field() !!}
                  {{ method_field('PATCH') }}
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-6">
                        <input name="name" id="name" type="text" class="form-control" required value="{{ $activity->name }}">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Type</label>
                      <div class="col-sm-6">
                        <select name="type" id="type" class="form-control" required>
                          <option>Health</option>
                          <option>Lifestyle</option>
                          <option>Nutrition</option>
                          <option>Exercise</option>
                          <option>Sleep</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label"> Date </label>
                      <div class="col-md-3 col-xs-7">
                        <div data-min-view="2" data-date-format="dd/mm/yyyy" class="input-group date datetimepicker">
                          <input name="date" id="expiry" size="16" type="text" value="{{$activity->date}}" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Completed</label>
                      <div class="col-sm-6">
                        <select name="is_completed" id="completed" class="form-control" required>


                          @if ($activity->is_completed)
                              <option value="1" selected>Yes</option>
                              <option value="0">No</option>
                          @else
                            <option value="1">Yes</option>
                              <option value="0" selected>No</option>
                          @endif
                        </select>
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
