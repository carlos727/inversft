@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<a class="btn btn-primary" href="{{ route('create_client') }}">Nuevo Cliente</a>
				</div>

				@if (count($clients) > 0)
					<table class="table table-hover">
						<thead>
							<tr>
								<th data-field="name">Nombre</th>
								<th data-field="id">Cedula</th>
								<th data-field="address">Dirección</th>
								<th data-field="phone">Celular</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($clients as $client)

									<tr>
										<td><div>{{ $client->name }}</div></td>
										<td><div>{{ $client->id }}</div></td>
										<td><div>{{ $client->address }}</div></td>
										<td><div>{{ $client->phone }}</div></td>
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