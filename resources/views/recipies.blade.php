@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Nutrition</h2>



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

<div class="row">
	<div class="col-md-12">
	<div class="grid">

    @foreach($recipies as $recipe)

    <div class=" grid-item">
              <div class="panel panel-border">
                <div class="panel-heading"><a target="_blank" href="{{ $recipe->recipe->url }}"><span class="title">{{ $recipe->recipe->label }}</span></a></div>
                <div class="panel-body">
                  <div><img src="{{ $recipe->recipe->image }}" style="width:100%; margin-bottom:10px;"/></div>
                  <div>
                  <p>Recipe by {{ $recipe->recipe->source }}</p>

                  <p>

                  <div class="list-group"><a href="#" class="list-group-item"><span class="badge badge-primary">{{round($recipe->recipe->calories, 2)}}</span> <span class="text-primary mdi mdi-fire icon"></span> Calories</a></div>

                  @foreach($recipe->recipe->dietLabels as $label)

                    <span class="badge badge-primary" style="font-weight:400;margin:3px;">{{$label}}</span>

                  @endforeach

                  @foreach($recipe->recipe->healthLabels as $label)

                    <span class="badge badge-primary" style="font-weight:400;margin:3px;">{{$label}}</span>

                  @endforeach

                  </p>





                  </div>
                </div>
              </div>
            </div>

    @endforeach

	<!-- new ones -->
	@foreach($recipies2 as $recipe)



    <div class=" grid-item">
              <div class="panel panel-border">
                <div class="panel-heading"><a target="_blank" href="{{ $recipe['food_url'] }}"><span class="title">{{ $recipe['food_name'] }}</span></a></div>
                <div class="panel-body">

				<!--	<div><img src="https://source.unsplash.com/300x300/?{{$recipe['food_name']}}" style="width:100%; margin-bottom:10px;"/></div>-->
                  <div class="list-group"><span class="badge badge-primary" style=" word-wrap: break-word;white-space: normal;line-height: 20px;">{{$recipe['food_description']}}</span></div>





                  </div>
                </div>
              </div>


    @endforeach
</div>
</div>
</div>




@stop

@section('footer')
<script src="{{ URL::asset('assets/lib/masonry/masonry.pkgd.min.js') }}"></script>
<script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
<script>
$(document).ready(function(){

// $('.grid').masonry({
//   // options
//   itemSelector: '.grid-item',
//   columnWidth: 300,
//   gutter: 25
// });

var $grid = $('.grid').imagesLoaded( function() {
// init Masonry after all images have loaded
$grid.masonry({
  columnWidth: 300,
  itemSelector: '.grid-item',
  gutter: 25
});
console.log('got here');
    $('.grid').animate({'opacity':1});
});

})

</script>

<style>
  .grid-item { width: 300px;  }

</style>


@stop
