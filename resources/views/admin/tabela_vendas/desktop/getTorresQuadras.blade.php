@if($empreendimento)
    @if($empreendimento->tipo == "Vertical")
    <div class="form-group">
        <label>Torre</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-building"></i>
            </span>
            <select class="form-control select-empreendimento" name="torre_id" id="torre_id" required>
                <option value="">Selecione uma torre</option>
                @foreach($empreendimento->torres as $torre)
                <option value="{{ $torre->id }}">{{ $torre->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @elseif($empreendimento->tipo == "Horizontal")
    <div class="form-group">
        <label>Quadra</label>
        <div class="input-group">
            <span class="input-group-addon">
                <i class="fa fa-building"></i>
            </span>
            <select class="form-control select-empreendimento" name="quadra_id" id="quadra_id" required>
                <option value="">Selecione uma quadra</option>
                @if (isset($empreendimento))
                @foreach($empreendimento->getQuadrasDisponiveis() as $quadra)
                <option value="{{ $quadra->id }}" @if(isset($tabela) && $tabela->empreendimento->quadra->id == $quadra->id) selected="true" @endif>{{ $quadra->nome }}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    @endif
@endif