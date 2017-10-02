<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update{{ $person->id }}" data-placement="top" title="Actualizar datos">A</button>

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
						<label for="address{{ $person->id }}" class="col-md-4 control-label">Dirección</label>

						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">
									<input id="address{{ $person->id }}_check" type="checkbox" name="address_check" onchange="requiredInput(this)">
								</span>

								<input id="address{{ $person->id }}" type="text" class="form-control" name="address" placeholder="{{ $person->address }}"
								value="{{ old('address') }}" autofocus>
							</div>

							@if ($errors->has('address'))
								<span class="help-block">
									<strong>{{ $errors->first('address') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
						<label for="phone{{ $person->id }}" class="col-md-4 control-label">Telefono</label>

						<div class="col-md-6">
							<div class="input-group">
								<span class="input-group-addon">
									<input id="phone{{ $person->id }}_check" type="checkbox" name="phone_check" onchange="requiredInput(this)">
								</span>

								<input id="phone{{ $person->id }}" type="text" class="form-control" name="phone" placeholder="{{ $person->phone }}"
								value="{{ old('phone') }}" autofocus>
							</div>

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