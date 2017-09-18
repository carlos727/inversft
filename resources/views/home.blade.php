@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					@include('button.credit.new')
					<a href="{{ route('create_collector') }}" class="btn btn-primary"><b>Nuevo Cobrador</b></a>
					@include('button.collector.list')
					@if (count($credits) > 0)
						<a href="{{ $download }}" class="btn btn-primary"><b>Excel</b></a>
					@endif
				</div>

				<div class="panel-body">
					@include('common.errors')
					@include('common.message')

					Listado de todos los creditos activos {{ $name }}
				</div>

				@if (count($credits) > 0)

					<table id="table-home" class="table table-hover">
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
											@include('common.delete_obj', ['id' => $credit->id,'route' => 'delete_credit','obj' => 'crédito'])
											<!-- @include('button.credit.update', ['credit' => $credit, 'clients' => $clients]) -->
											@include('button.credit.pay', ['credit' => $credit])
											@include('button.credit.payments', ['credit' => $credit])
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
