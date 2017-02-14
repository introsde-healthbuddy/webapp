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
                  <form action="{{ action('ActivityController@store')}}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {!! csrf_field() !!}
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Name</label>
                      <div class="col-sm-6">
                        <input name="name" id="name" type="text" class="form-control" required>
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
                      <label class="col-sm-3 control-label">Area</label>
                      <div class="col-sm-6">
                        <input name="area" id="area" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Description</label>
                      <div class="col-sm-6">
                        <textarea id="description" name="description" class="form-control" required></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label"> Deadline </label>
                      <div class="col-md-3 col-xs-7">
                        <div data-min-view="2" data-date-format="yyyy-mm-dd" class="input-group date datetimepicker">
                          <input name="expiry" id="expiry" size="16" type="text" value="" class="form-control"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Completed</label>
                      <div class="col-sm-6">
                        <select name="completed" id="completed" class="form-control" required>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
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

