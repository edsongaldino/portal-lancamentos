<label>Torres</label>
<select name="torre_id" id="torre_id" class="form-control">
	@foreach ($torres as $torre)
		<option value="{{ $torre['id'] }}">{{ $torre['nome'] }}</option>
	@endforeach
</select>