<option value=""></option>
@foreach ($cidades as $cidade)
	<option value="{{ $cidade->id }}">{{ $cidade->nome }}</option>
@endforeach
