<label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-arrows-alt" aria-hidden="true"></i> Planta</label>
<div class="col-sm-4" id="box_planta_unidade">
	@if ($planta_nome)
		<input type="text" name="planta" value="{{ $planta_nome }}" readonly="true" class="form-control">
	@else
		@if (count($plantas))
			<select id="planta" name="planta_id" class="form-control" required="">
				<option value="">Selecione uma planta</option>
				@foreach ($plantas as $planta)
					<option value="{{ $planta->id }}">{{ $planta->nome }}</option>
				@endforeach
			</select>
		@endif
	@endif
</div>