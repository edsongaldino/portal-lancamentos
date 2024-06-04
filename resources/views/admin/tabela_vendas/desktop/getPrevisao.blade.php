<div class="form-group">
    <label>Previsão de entrega</label>
    <div class="input-group">
        <span class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span>
        <input type="text" class="form-control previsao-entrega" value="{{ mes_extenso_abreviado($previsao->previsao_entrega_mes) }}/{{ $previsao->previsao_entrega_ano }}" readonly>
    </div>
</div>