<div class="panel panel-accordion panel-accordion-honorarios">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Honorarios">
        <i class="fa fa-building"></i> Honorários de Intermediação (Comissão)
      </a>
    </h4>
  </div>
  <div id="collapse2Honorarios" class="accordion-body collapse">
    <div class="panel-body">
      <form id="honorarios-intermediacao" class="form-horizontal form-bordered">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif

        <div class="form-group">

          <label for="telefoneCentral" class="col-md-2 control-label"><strong>Percentual</strong><br/>(Imobiliária)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-percent" aria-hidden="true"></i>
              </span>
              <input class="form-control valor-percentual-honorario moeda" id="percentual_imobiliaria" type="text" name="percentual_imobiliaria" @if (isset($entry) && $entry->caracteristicas->where('nome', 'percentual_imobiliaria')->first())value="{{  $entry->caracteristicas->where('nome', 'percentual_imobiliaria')->first()->pivot->valor }}"@endif maxlength="15" autocomplete="off">
            </div>
          </div>

          <label for="telefoneCentral" class="col-md-2 control-label"><strong>Percentual</strong><br/>(Corretor)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-percent" aria-hidden="true"></i>
              </span>
              <input class="form-control valor-percentual-honorario moeda" type="text" name="percentual_corretor" @if (isset($entry) && $entry->caracteristicas->where('nome', 'percentual_corretor')->first())value="{{  $entry->caracteristicas->where('nome', 'percentual_corretor')->first()->pivot->valor }}"@endif maxlength="15" autocomplete="off">
            </div>
          </div>

        </div>

        <div class="form-group">

          <label for="telefoneCentral" class="col-md-2 control-label"><strong>Intermediação</strong><br/>(Lançamentos Online)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-percent" aria-hidden="true"></i>
              </span>
              <input class="form-control valor-percentual-honorario moeda"  type="text" name="percentual_lancamentos" readonly @if (isset($entry) && $entry->caracteristicas->where('nome', 'percentual_lancamentos')->first())value="{{  $entry->caracteristicas->where('nome', 'percentual_lancamentos')->first()->pivot->valor }}"@else value="1,00" @endif maxlength="15" autocomplete="off">
            </div>
          </div>

        </div>
  
        <div class="form-group">
          <div class="col-md-12">
             
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-honorarios-intermediacao"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif
            
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>