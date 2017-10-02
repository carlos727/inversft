 	@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					@include('common.message')
					@include('common.errors')
					<h3><b>{{ ucfirst($person) }}</b></h3>
				</div>

				<div class="panel-body">
					Listado de todos los {{ $person }} que ha tenido la inversión
					@if ($person != 'clientes')
						@include('button.collector.status')
					@endif
				</div>

				@if (count($people) > 0)
					<table class="table table-hover">
						<thead>
							<tr>
								<th data-field="name">Nombre</th>
								<th data-field="id">Cedula</th>
								<th data-field="address">Dirección</th>
								<th data-field="phone">Celular</th>
								<th data-field="operation">Operaciones</th>
							</tr>
						</thead>

						<tbody id="tb-clt">
							@foreach ($people as $p)

									<tr>
										<td><div>{{ $p->name }}</div></td>
										<td><div>{{ $p->id }}</div></td>
										<td><div>{{ $p->address }}</div></td>
										<td><div>{{ $p->phone }}</div></td>
										<td>
											<div>
												@if ($person == 'clientes')
													@include('common.delete_obj',[
														'id' => $p->id, 'route' => 'delete_client', 'obj' => 'cliente'
													])
													@include('common.update_per', [
														'person' => $p, 'route' => 'update_client'
													])
												@else
													@include('common.delete_obj',[
														'id' => $p->id, 'route' => 'delete_collector', 'obj' => 'cobrador'
													])
													@include('common.update_per', [
														'person' => $p, 'route' => 'update_collector'
													])
													@include('button.collector.change_status', ['id' => $p->id])
												@endif
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