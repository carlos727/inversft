<div class="btn-group">
	<button type="button" class="btn btn-default">Mostrar cobro de</button>
	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>

	<ul class="dropdown-menu">

		<li>
			<a href="{{ route('home') }}">
				Todos  <span class="badge">{{ count($credits) }}</span>
			</a>
		</li>

		@foreach ($collectors as $collector)

			<li role="separator" class="divider"></li>
			<li>
				<a href="{{ route('credits_collector', ['id' => $collector->id]) }}">
					{{ $collector->name }}  <span class="badge">{{ $collector->credits->where('active', 1)->count() }}</span>
				</a>
			</li>

		@endforeach

	</ul>
</div>