<div class="panel panel-accordion panel-accordion-green">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Four">
        <i class="fa fa-cloud"></i> Itens de Lazer
      </a>
    </h4>
  </div>
  <div id="collapse2Four" class="accordion-body collapse">
    <div class="panel-body">
      <form id="itens-lazer-empreendimento" class="form-horizontal form-bordered" method="post">
        @if (isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif

        <div class="form-group">
          <div class="col-md-12">
            <select name="item_lazer[]" multiple data-plugin-selectTwo class="form-control populate">
              <optgroup label="Itens de Lazer">
                @foreach ($itens_lazer as $item)
                
                <option value="{{ $item['id'] }}" @if (isset($item['selected']) && $item['selected'] == 'true') selected="true" @endif>
                  {{ $item['nome'] }}
                </option>  

                @endforeach
              </optgroup>

            </select>
          </div>    
        </div>
        

        <div class="form-group">
          <div class="col-md-12">

            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-itens-lazer-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif

          </div>
        </div>


      </form>
    </div>
  </div>
</div>