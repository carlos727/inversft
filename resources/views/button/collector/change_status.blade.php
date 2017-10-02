<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#status{{ $id }}" data-placement="top" title="Habilitar/Inhabilitar cobrador"><b>H</b></button>
<div class="modal fade" id="status{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Habilitar/Inhabilitar Cobrador</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Estas seguro de realizar esta acción?</p>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-default" data-dismiss="modal">No</button>
				<a href="{{ route('change_status_collector', ['id' => $id]) }}" class="btn btn-primary">Si</a>
			</div>
		</div>
	</div>
</div>