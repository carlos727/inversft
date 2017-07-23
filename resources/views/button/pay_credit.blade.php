<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pay{{ $credit->id }}">P</button>

<div class="modal fade" id="pay{{ $credit->id }}" tabindex="-1" role="dialog"
aria-labelledby="DeleteModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Pagar Crédito</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="{{ route('store_payment') }}">
					{{ csrf_field() }}

					<input type="hidden" name="credit_id" value="{{ $credit->id }}">

					<div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
						<label for="value" class="col-md-4 control-label">Cantidad</label>

						<div class="col-md-6">
							<input id="value" type="number" class="form-control" name="value" placeholder="{{ $credit->fee_val() }}"
							value="{{ old('value') }}" required autofocus>

							@if ($errors->has('value'))
								<span class="help-block">
									<strong>{{ $errors->first('value') }}</strong>
								</span>
							@endif
						</div>
					</div>

					<div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
						<label for="date" class="col-md-4 control-label">Fecha</label>

						<div class="col-md-6">
							<input id="date" type="date" class="form-control" name="date" value="{{ Carbon\Carbon::now()->toDateString() }}" required autofocus>

							@if ($errors->has('date'))
								<span class="help-block">
									<strong>{{ $errors->first('date') }}</strong>
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