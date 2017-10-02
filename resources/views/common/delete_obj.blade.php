<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete{{ $id }}" data-placement="top" title="Eliminar {{ $obj }}">E</button>

<div class="modal fade" id="delete{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Eliminar {{ ucfirst($obj) }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<p>¿Estas seguro que quieres eliminar este {{ $obj }}?</p>
			</div>

			<div class="modal-footer">
				<button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
				<form action="{{ route($route, ['id' => $id]) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit" class="btn btn-danger">Si</button>
				</form>
			</div>
		</div>
	</div>
</div>