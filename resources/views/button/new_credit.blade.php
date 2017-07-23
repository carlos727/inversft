<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-credit">Nuevo Credito</button>
<div class="modal fade" id="new-credit" tabindex="-1" role="dialog" aria-labelledby="creditModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Nuevo Crédito</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Esta es la primera vez que el deudor solicita un préstamo?</p>
			</div>
			<div class="modal-footer">
				<a href="{{ route('create_client') }}" class="btn btn-primary">Si</a>
				<a href="{{ route('create_credit') }}" class="btn btn-default">No</a>
			</div>
		</div>
	</div>
</div>
