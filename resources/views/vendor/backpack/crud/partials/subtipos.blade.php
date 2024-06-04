<option>Selecione o subtipo</option>
@foreach ($subtipos as $subtipo)
    <option value="{{ $subtipo['id'] }}">{{ $subtipo['nome'] }}</option>
@endforeach

