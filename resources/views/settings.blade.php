@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Profile</h2>

            <span style="float:right; padding-top:10px;">

            </span>

            @include('partials.quote')
	</div>

	<div class="col-sm-12 col-md-10 col-lg-8">
	  <div class="panel panel-default panel-border-color panel-border-color-primary">

		<div class="panel-body">
		  <form action="{{action('SettingsController@update', \Auth::user()->id)}}" method="POST" class="form-horizontal">

			  	<input type="hidden" name="_method" value="PUT">
      			<input type="hidden" name="_token" value="{{ csrf_token() }}">

			<div class="form-group xs-mt-10">
			  <label for="firstname" class="col-sm-2 control-label">First Name</label>
			  <div class="col-sm-10">
				<input id="firstname" name="firstname" type="text" placeholder="First Name" class="form-control" value="{{$data->firstname}}">
			  </div>
			</div>

			<div class="form-group xs-mt-10">
			  <label for="lastname" class="col-sm-2 control-label">Last Name</label>
			  <div class="col-sm-10">
				<input id="lastname" name="lastname" type="text" placeholder="Last Name" class="form-control" value="{{$data->lastname}}">
			  </div>
			</div>

			<div class="form-group xs-mt-10">
			  <label for="email" class="col-sm-2 control-label">Email</label>
			  <div class="col-sm-10">
				<input id="email" name="email" type="email" placeholder="Email" class="form-control" readonly value="{{$data->email}}">
			  </div>
			</div>

			<div class="form-group">

				<label for="email" class="col-sm-2 control-label">Birthdate</label>
				<div class="col-sm-10">
					<div data-min-view="2" data-date-format="dd/mm/yyyy" class="input-group date datetimepicker">
					  <input id="birthdate" name="birthdate" size="16" type="text" value="{{$data->birthdate}}" class="form-control" placeholder="Birthdate"><span class="input-group-addon btn btn-primary"><i class="icon-th mdi mdi-calendar"></i></span>
					</div>
				</div>

			</div>

			<div class="row xs-pt-15">

			  <div class="col-xs-12">
				<p class="text-right">
				  <button type="submit" class="btn btn-space btn-primary">Update</button>
				</p>
			  </div>
			</div>
		  </form>
		</div>
	  </div>
	</div>
</div>


@include('partials.errors')

@stop
