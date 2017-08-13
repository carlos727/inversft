<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update{{ $person->id }}">A</button>

<div class="modal fade" id="update{{ $person->id }}" tabindex="-1" role="dialog"
aria-labelledby="DeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Actualizar datos</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="{{ route($route, ['id' => $person->id]) }}">
					{{ csrf_field() }}
					{{ method_field('PUT') }}

					<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
						<label for="address" class="col-md-4 control-label">Dirección</label>

						<div class="col-md-6">
							<input id="address" type="text" class="form-control" name="address" placeholder="{{ $person->address }}"
							value="{{ old('address') }}" required autofocus>

							@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label for="phone" class="col-md-4 control-label">Telefono</label>

						<div class="col-md-6">
							<input id="phone" type="text" class="form-control" name="phone" placeholder="{{ $person->phone }}"
							value="{{ old('phone') }}" required autofocus>

							@if ($errors->has('phone'))
								<span class="help-block">
									<strong>{{ $errors->first('phone') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-primary">Guardar</button>
							<button type="submit" class="btn btn-default" data-dismiss="modal">Cancelar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>