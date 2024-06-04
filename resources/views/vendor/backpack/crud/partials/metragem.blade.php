<label class="col-sm-2 control-label" for="w4-password"><i class="fa fa-arrows-alt" aria-hidden="true"></i> Tamanho do Lote</label>
<div class="col-sm-4" id="box_planta_unidade">
	@if (isset($unidade))
		<input type="text" name="metragem_total" value="{{ $unidade->caracteristicas->where('nome', 'metragem_total')->first() }}" readonly="true" class="form-control">
	@else
		<input type="text" name="metragem_total" id="metragem_total" class="form-control" value="">
	@endif
</div>