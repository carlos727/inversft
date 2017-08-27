@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<!-- <a class="btn btn-primary" href="{{ route('create_client') }}">Nuevo Cliente</a> -->
					<h3><b>Pagos</b></h3>
				</div>

				<div class="panel-body">
					Listado de todos los pagos que ha tenido la inversión
				</div>

				@if (count($payments) > 0)
					<table class="table table-hover">
						<thead>
							<tr>
								<th data-field="name">Nombre</th>
								<th data-field="credito">Credito</th>
								<th data-field="value">Valor</th>
								<th data-field="date">Fecha</th>
								<th data-field="operation">Operaciones</th>
							</tr>
						</thead>

						<tbody id="tb-clt">
							@foreach ($payments as $payment)

									<tr>
										<td><div>{{ $payment->credit->client->name }}</div></td>
										<td><div>{{ $payment->credit->start_at }}</div></td>
										<td><div>{{ $payment->value }}</div></td>
										<td><div>{{ $payment->date }}</div></td>
										<td>
											<div>
												@include('common.delete_obj', ['id' => $payment->id, 'route' => 'delete_payment', 'obj' => 'pago'])
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