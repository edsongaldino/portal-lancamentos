<select name="cidade_id" id="cidade" class="form-control">	
	<option value=""></option>
	@foreach ($cidades as $cidade)
		<option value="{{ $cidade['id'] }}">{{ $cidade['nome'] }}</option>
	@endforeach
</select>
