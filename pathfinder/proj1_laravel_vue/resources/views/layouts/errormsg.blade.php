@if (count($errors))
	<div class="alert alert-danger">
		<ul>
			<!-- errors is available to every single view -->
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif
