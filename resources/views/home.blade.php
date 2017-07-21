@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#creditModal">
						Nuevo Credito
					</button>
					<div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
				</div>

				<div class="panel-body">
					Listado de todos los creditos activos.
				</div>

				@if (count($credits) > 0)
					<table class="table table-hover">
						<thead>
							<tr>
								<th data-field="name">Deudor</th>
								<th data-field="address">Dirección</th>
								<th data-field="fee">Cuota</th>
								<th data-field="">Saldo</th>
								<th data-field="operation">Operaciones</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($credits as $credit)

								<tr>
									<td><div>{{ $credit->client->name }}</div></td>
									<td><div>{{ $credit->client->address }}</div></td>
									<td><div>{{ $credit->fee_val() }}</div></td>
									<td><div>{{ $credit->balance() }}</div></td>
									<td><div></div></td>
								</tr>

							@endforeach
						</tbody>
					</table>
				@endif

			</div>
		</div>
	</div>
</div>
@endsection
