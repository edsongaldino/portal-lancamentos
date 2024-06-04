<div class="panel panel-accordion panel-accordion-midias">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Arquivos">
        <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Arquivos (PDF)
      </a>
    </h4>
  </div>
  <div id="collapse2Arquivos" class="accordion-body collapse">
    <div class="panel-body">
      <form id="arquivos-empreendimento" class="form-horizontal form-bordered" enctype="multipart/form-data">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif
        
        <div class="form-group" style="padding-right: 15px;">
          <label for="Link Chat" class="col-md-2 control-label">Memorial Descritivo</label>
          <div class="col-md-9">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-file-text" aria-hidden="true"></i>
              </span>
              <input type="hidden" name="tipo" value="Memorial Descritivo">
              <input class="form-control" type="file" name="memorial_descritivo">
            </div>
          </div>  
          @if(isset($entry) && $entry->arquivos->where('tipo', 'Memorial Descritivo')->first())
          <a class="btn btn-info col-md-1 btn-download" href="/uploads/arquivos/{{  $entry->arquivos->where('tipo', 'Memorial Descritivo')->first()->arquivo ?? '' }}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a>
          @else
          <button class="btn btn-info col-md-1 btn-download-off"><i class="fa fa-download" aria-hidden="true"></i></button>
          @endif
        </div>

  
        <div class="form-group">
          <div class="col-md-12">
             
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-arquivos-empreendimento"><i class="fa fa-save"></i> Salvar Arquivo</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar Arquivo</button> 
            @endif
            
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>