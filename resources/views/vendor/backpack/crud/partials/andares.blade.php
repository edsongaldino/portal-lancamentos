<label class="col-sm-2 control-label" for="w4-username"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i> Andar</label>
<div class="col-sm-4">
	@if (isset($andares))
	<select id="andar" name="andar_id" class="form-control" required="">
		<option value="">Selecione o andar</option>
		@foreach ($andares as $andar)
			<option value="{{ $andar->id }}">{{ $andar->numero }}</option>
		@endforeach
	</select>
	@else
		<h6>Nenhum andar cadastrado foi encontrado</h6>
	@endif
</div>