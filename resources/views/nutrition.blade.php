@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Nutrition</h2>

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
            <div class="col-md-12">
              <div class="panel panel-default panel-border-color panel-border-color-primary">
                <div class="panel-heading"></div>
                <div class="panel-body">
                  <form action="{{ action('NutritionController@search')}}" method="POST" style="border-radius: 0px;" class="form-horizontal group-border-dashed">
                  {!! csrf_field() !!}
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Keywords</label>
                      <div class="col-sm-6">
                        <input name="keywords" id="keywords" type="text" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label">Diet</label>
                      <div class="col-sm-6">
                        <select name="diet" id="diet" class="form-control">
                        <option>Select optional preference</option>
                          <option value="balanced">Balanced</option>
                          <option value="high-fiber">High-Fiber</option>
                          <option value="high-protein">High-Protein</option>
                          <option value="low-carb">Low-Carb</option>
                          <option value="low-fat">Low-Fat</option>
                          <option value="low-sodium">Low-Sodium</option>

                       
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-3 control-label">Health Preferences</label>
                      <div class="col-sm-6">
                        <select name="health" id="health" class="form-control">

                        	<option>Select optional preference</option>
                          <option value="alcohol-free">Alcohol-free</option>
                          <option value="low-sugar">No Sugar</option>
                          <option value="pork-free">Pork-free</option>
                          <option value="sugar-concious">Sugar-concious</option>
                          <option value="vegetarian">Vegeterian</option>
                          <option value="vegan">Vegan</option>
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

