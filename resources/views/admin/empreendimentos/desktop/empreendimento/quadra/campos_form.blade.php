<div class="form-group">
  <label class="col-md-2 control-label">Nome da Quadra</label>
  <div class="col-md-6">
    <input class="form-control" data-plugin-maxlength maxlength="20" name="nome" @if (isset($quadra))value="{{ $quadra->nome }}"@endif />
  </div>


  <label class="col-md-2 control-label">Total de unidades:</label>
  <div class="col-md-2">
    <input class="form-control" type="number" min="1" name="total_unidades" @if (isset($quadra))value="{{ $quadra->total_unidades }}"@endif @if(isset($quadra))disabled="true"@endif>
  </div>

</div>

<div class="form-group">
  <label class="col-md-2 control-label">Mês Entrega (Previsão):</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </span>
      <select class="form-control" name="previsao_entrega_mes">
        <option>Escolha o mês</option>
        <option value="01" @if(isset($quadra) && $quadra->previsao_entrega_mes == "01")selected="true"@endif>Janeiro</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "02")selected="true"@endif value="2">Fevereiro</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "03")selected="true"@endif value="3">Março</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "04")selected="true"@endif value="4">Abril</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "05")selected="true"@endif value="5">Maio</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "06")selected="true"@endif value="6">Junho</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "07")selected="true"@endif value="7">Julho</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "08")selected="true"@endif value="8">Agosto</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "09")selected="true"@endif value="9">Setembro</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "10")selected="true"@endif value="10">Outubro</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "11")selected="true"@endif value="11">Novembro</option>
        <option @if(isset($quadra) && $quadra->previsao_entrega_mes == "12")selected="true"@endif value="12">Dezembro</option>
      </select>              
    </div>        
  </div>

  <label class="col-md-2 control-label">Ano Entrega (Previsão):</label>
  <div class="col-md-4">
    <div class="input-group">
      <span class="input-group-addon">
        <i class="fa fa-calendar"></i>
      </span>
      <select class="form-control" name="previsao_entrega_ano">
        <option>Escolha o ano</option>
        @php
          $year = date("Y")+10;
          $anos = '';
          for ($i = date("Y")-10; $i < $year ; $i++) {
            $selected = $quadra->previsao_entrega_ano == $i ? "selected='true'" : '';
            $anos .= "<option ". $selected ." value='". $i . "'>". $i ."</option>";
          }
        @endphp
        {!! $anos !!}
      </select>              
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-2 control-label">Nomenclatura (Unidades):</label>
  <div class="col-md-4">
    <select class="form-control" name="nomenclatura" @if(isset($quadra))disabled="true"@endif>
      <option value="Reiniciar" @if (isset($quadra) && $quadra->nomenclatura == 'Reiniciar') selected="true" @endif>Sequencial com reínicio por quadra (1,2,3 Quadra 1, 1,2,3 Quadra 2...)</option>                                    
      <option value="Sequencial" @if (isset($quadra) && $quadra->nomenclatura == 'Sequencial') selected="true" @endif>Sequencial (1,2,3,4,5...)</option>      
    </select>
  </div>

  <label class="col-md-2 control-label">Situação da quadra:</label>
  <div class="col-md-3">
    <select class="form-control" name="status">
      <option value="Liberada" @if (isset($quadra) && $quadra->status == 'Liberada') selected="true" @endif>Liberada</option>
      <option value="Bloqueada" @if (isset($quadra) && $quadra->status == 'Bloqueada') selected="true" @endif>Bloqueada</option>
      <option value="Entregue" @if (isset($quadra) && $quadra->status == 'Entregue') selected="true" @endif>Entregue</option>
    </select>
  </div>

</div>