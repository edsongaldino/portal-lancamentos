<option>Selecione a variação</option>
@foreach ($variacoes as $variacao)
    <option value="{{ $variacao['id'] }}">{{ $variacao['nome'] }}</option>
@endforeach

