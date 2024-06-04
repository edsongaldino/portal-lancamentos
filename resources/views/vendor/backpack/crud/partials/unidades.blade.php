<label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-codepen" aria-hidden="true"></i> Unidade</label>
<div class="col-sm-4">
	@if (count($unidades))
	<select id="unidade" name="unidade_id" class="form-control" required="">
		<option value="">Selecione uma unidade</option>
		@foreach ($unidades as $unidade)
			@if ($unidade->ofertaValida->count() == 0)
				<option value="{{ $unidade->id }}">{{ $unidade->nome }}</option>
			@endif
		@endforeach
	</select>
	@else
		<h6>Nenhuma unidade disponível encotrada</h6>
	@endif
</div>