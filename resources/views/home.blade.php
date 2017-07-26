@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					@include('button.new_credit')
				</div>

				<div class="panel-body">
					@include('common.errors')
					@include('common.message')

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
									<td>
										<div>
											@include('button.delete_obj', ['id' => $credit->id,'route' => 'delete_credit','obj' => 'crédito'])
											@include('button.update_credit', ['credit' => $credit, 'clients' => $clients])
											@include('button.pay_credit', ['credit' => $credit])
										</div>
									</td>
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
