<div class="input-group btn-group">
    <span class="input-group-addon">
        <i class="fa fa-sort-numeric-desc"></i>
    </span>    
    <select class="form-control" placeholder="Selecione" name="unidade_filtro">
        <option value="" disabled hidden selected>Selecione a unidade</option>
        @foreach($unidades as $unidade)
        <option value="{{ $unidade->id }}">Unidade {{ $unidade->nome }}</option>
        @endforeach
    </select>      
</div>