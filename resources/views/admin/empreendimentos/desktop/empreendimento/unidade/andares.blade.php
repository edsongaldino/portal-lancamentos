@if (isset($andares))
	<select id="andar" name="andar_id" class="form-control" required="">
		<option value="">Selecione o andar</option>
		@foreach ($andares as $andar)
			<option value="{{ $andar->id }}">{{ $andar->numero }}</option>
		@endforeach
	</select>
@else
	<h6>Nenhum andar foi encontrado</h6>
@endif