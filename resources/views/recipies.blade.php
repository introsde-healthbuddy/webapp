@extends('layout')

@section('content')

<div class="row">
	<div class="page-head">

            <h2 class="page-head-title" style="display:inline;">Nutrition</h2>

            

            @include('partials.quote')
	</div>
</div>

<div class="row grid">

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
    
</div>




@stop

@section('footer')
<script src="{{ URL::asset('assets/lib/masonry/masonry.pkgd.min.js') }}"></script>
<script>
$(document).ready(function(){

$('.grid').masonry({
  // options
  itemSelector: '.grid-item',
  columnWidth: 300,
  gutter: 25
});

})
  
</script>

<style>
  .grid-item { width: 300px;  }

</style>


@stop

