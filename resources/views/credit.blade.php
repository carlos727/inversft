@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nuevo Crédito</div>
				<div class="panel-body">
					<form class="form-horizontal" method="POST" action="{{ route('credit') }}">
						{{ csrf_field() }}

						<div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
							<label for="client_id" class="col-md-4 control-label">Cliente</label>

							<div class="col-md-6">
								<input id="client_id" type="text" class="form-control" name="client_id" value="{{ old('client_id') }}" required autofocus>

								@if ($errors->has('client_id'))
									<span class="help-block">
										<strong>{{ $errors->first('client_id') }}</strong>
									</span>
								@endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
							<label for="value" class="col-md-4 control-label">Préstamo</label>

							<div class="col-md-6">
								<input id="value" type="text" class="form-control" name="value" value="{{ old('value') }}" required autofocus>

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
								<input fee="fee" type="fee" class="form-control" name="fee" value="{{ old('fee') }}" required autofocus>

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
								<input id="type" type="text" class="form-control" name="type" value="{{old('type')}}" required autofocus>

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
								<input id="revenue" type="text" class="form-control" name="revenue" value="{{ old('revenue') }}" required autofocus>

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
								<input id="start_at" type="text" class="form-control" name="start_at" value="{{ old('start_at') }}" required autofocus>

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