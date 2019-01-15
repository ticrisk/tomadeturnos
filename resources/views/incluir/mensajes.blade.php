{{--
@if(count($errors)>0)
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@else
	@include('flash::message')
@endif
--}}

@if(count($errors)>0)
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>

@elseif(Session::has('success'))
	<div class="alert alert-success">
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-hidden="true"
		>&times;</button>
		{!!  Session::get('success') !!}
	</div>
@elseif(Session::has('danger'))
	<div class="alert alert-danger">
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-hidden="true"
		>&times;</button>
		{!!  Session::get('danger') !!}
	</div>
@elseif(Session::has('warning'))
	<div class="alert alert-warning">
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-hidden="true"
		>&times;</button>
		{!!  Session::get('warning') !!}
	</div>
@elseif(Session::has('info'))
	<div class="alert alert-info">
		<button type="button"
				class="close"
				data-dismiss="alert"
				aria-hidden="true"
		>&times;</button>
		{!!  Session::get('info') !!}
	</div>
@endif