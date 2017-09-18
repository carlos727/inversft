<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payments{{ $credit->id }}">Pagos</button>

<div class="modal fade" id="payments{{ $credit->id }}" tabindex="-1" role="dialog"
aria-labelledby="DeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pagos Realizados</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<table class="table table-hover table-payments">
					<thead>
						<th data-field="date">Fecha</th>
						<th data-field="fee">Cuota</th>
					</thead>

					<tbody>

						@foreach ($credit->payments as $payment)

							<tr>
								<td><div>{{ $payment->date }}</div></td>
								<td><div>{{ $payment->value }}</div></td>
							</tr>

						@endforeach

						<tr>
							<td><div>Total</div></td>
							<td><div>{{ $credit->total_paid() }}</div></td>
						</tr>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>