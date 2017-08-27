<div class="btn-group">
	<button type="button" class="btn btn-default">Mostrar cobro de</button>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>

	<ul class="dropdown-menu">

		@foreach ($collectors as $collector)
			<li>
				<a href="{{ route('credits_collector', ['id' => $collector->id]) }}">{{ $collector->name }}</a>
			</li>
		@endforeach

	</ul>
</div>