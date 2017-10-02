<div class="btn-group">
	<button type="button" class="btn btn-default">Mostrar cobradores</button>
	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		<span class="caret"></span>
		<span class="sr-only">Toggle Dropdown</span>
	</button>

	<ul class="dropdown-menu">

		<li>
			<a href="{{ route('list_collectors') }}">
				Habilitados <span class="badge">{{ $collectors->where('active', 1)->count() }}</span>
			</a>
		</li>

		<li role="separator" class="divider"></li>

		<li>
			<a href="{{ route('list_collectors', ['active' => 0]) }}">
				Inhabilitados  <span class="badge">{{ $collectors->where('active', 0)->count() }}</span>
			</a>
		</li>
	</ul>
</div>