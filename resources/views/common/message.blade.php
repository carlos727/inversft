@if (Session::has('success'))
	<div class="alert alert-success .alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>

		<strong>{{ Session::get('success') }}</strong>
	</div>
@endif

@if (Session::has('alert'))
	<div class="alert alert-danger .alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>

		<strong>{{ Session::get('alert') }}</strong>
	</div>
@endif

@if (Session::has('warning'))
	<div class="alert alert-warning .alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>

		<strong>{{ Session::get('warning') }}</strong>
	</div>
@endif

@if (Session::has('info'))
	<div class="alert alert-info .alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>

		<strong>{{ Session::get('info') }}</strong>
	</div>
@endif