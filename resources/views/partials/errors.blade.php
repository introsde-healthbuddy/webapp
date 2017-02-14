<div class="row">
<div class="col-md-12">
@if(count($errors))
	<div class="alert {{ Session::get('alert-class', 'alert-warning') }}" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif


@if(Session::has('message'))
<div class="alert {{ Session::get('alert-class', 'alert-info') }}" role="alert">
	<p class="">{{ Session::get('message') }}</p>
</div>
@endif
</div>
</div>



