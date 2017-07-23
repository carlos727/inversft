@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					@include('common.message')

					Nuevo Crédito
				</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('store_credit') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
							<label for="client_id" class="col-md-4 control-label">Cliente</label>

							<div class="col-md-6">
								<select class="form-control" id="client_id" name="client_id">
									<option value="" disabled selected>Seleccionar...</option>
									@foreach ($clients as $client)
										<option value="{{ $client->id }}">{{ $client->name }} ({{ $client->id }})</option>
									@endforeach
							    </select>

							    @if ($errors->has('client_id'))
									<span class="help-block">
										<strong>{{ $errors->first('client_id') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
							<label for="value" class="col-md-4 control-label">Cantidad</label>

							<div class="col-md-6">
								<input id="value" type="number" class="form-control" name="value" placeholder="50000" step="50000"
								value="{{ old('value') }}" required autofocus>

								@if ($errors->has('value'))
									<span class="help-block">
										<strong>{{ $errors->first('value') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('fee') ? ' has-error' : '' }}">
							<label for="fee" class="col-md-4 control-label">No. de cuotas</label>

							<div class="col-md-6">
								<input id="fee" type="number" class="form-control" name="fee" placeholder="30" value="{{ old('fee') }}" required autofocus>

								@if ($errors->has('fee'))
									<span class="help-block">
										<strong>{{ $errors->first('fee') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
							<label for="type" class="col-md-4 control-label">Tipo</label>

							<div class="col-md-6">
								<select id="type" class="form-control" name="type">
									<option value="" disabled selected>Seleccionar...</option>
									<option value="0">Diario</option>
									<option value="1">Semanal</option>
									<option value="2">Quincenal</option>
									<option value="3">Mensual</option>
								</select>

								@if ($errors->has('type'))
									<span class="help-block">
										<strong>{{ $errors->first('type') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('revenue') ? ' has-error' : '' }}">
							<label for="revenue" class="col-md-4 control-label">Rédito</label>

							<div class="col-md-6">
								<input id="revenue" type="number" class="form-control" name="revenue" placeholder="20" value="{{ old('revenue')}}" required autofocus>

								@if ($errors->has('revenue'))
									<span class="help-block">
										<strong>{{ $errors->first('revenue') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('start_at') ? ' has-error' : '' }}">
							<label for="start_at" class="col-md-4 control-label">Fecha</label>

							<div class="col-md-6">
								<input id="start_at" type="date" class="form-control" name="start_at" value="{{ old('start_at') }}" required autofocus>

								@if ($errors->has('start_at'))
									<span class="help-block">
										<strong>{{ $errors->first('start_at') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection