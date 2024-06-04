<div class="panel panel-accordion panel-accordion-midias">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Nine">
        <i class="fa fa-building"></i> Canais de Atendimento
      </a>
    </h4>
  </div>
  <div id="collapse2Nine" class="accordion-body collapse">
    <div class="panel-body">
      <form id="canais-empreendimento" class="form-horizontal form-bordered">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif
        
        <div class="form-group">
          <label for="Link Chat" class="col-md-2 control-label">Link Chat</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-comments-o"></i>
              </span>
              <input class="form-control" type="text" name="link_chat" @if (isset($entry) && $entry->caracteristicas->where('nome', 'link_chat')->first())value="{{  $entry->caracteristicas->where('nome', 'link_chat')->first()->pivot->valor }}"@endif>
            </div>
          </div>  
        </div>

        <div class="form-group">

          <label for="telefoneCentral" class="col-md-2 control-label"><strong>Telefone</strong><br/>(Central de Vendas)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              <input class="form-control celular" id="phone" data-plugin-masked-input="" data-input-mask="(99) 99999-9999" placeholder="(12) 1234-1234" type="text" name="telefone_central" @if (isset($entry) && $entry->caracteristicas->where('nome', 'telefone_central')->first())value="{{  $entry->caracteristicas->where('nome', 'telefone_central')->first()->pivot->valor }}"@endif maxlength="15" autocomplete="off">
            </div>
          </div>

          <label for="telefoneCentral" class="col-md-2 control-label">Whatsapp (Atendimento)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-whatsapp"></i>
              </span>
              <input class="form-control" placeholder="12 1234-1234" type="text" name="whatsapp_atendimento" @if (isset($entry) && $entry->caracteristicas->where('nome', 'whatsapp_atendimento')->first())value="{{  $entry->caracteristicas->where('nome', 'whatsapp_atendimento')->first()->pivot->valor }}"@endif maxlength="15" autocomplete="off">
            </div>
          </div>

        </div>

        <div class="form-group">
          <label for="Link Chat" class="col-md-2 control-label"><strong>E-mail</strong><br/>(Envio de Leads)</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </span>
              <input name="email_lead" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" @if (isset($entry) && $entry->caracteristicas->where('nome', 'email_lead')->first())value="{{  $entry->caracteristicas->where('nome', 'email_lead')->first()->pivot->valor }}"@endif />
            </div>
          </div>  
        </div>

        <div class="form-group">
          <label for="Link Chat" class="col-md-2 control-label"><strong>E-mail</strong><br/>(Envio de Propostas)</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </span>
              <input name="email_proposta" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" @if (isset($entry) && $entry->caracteristicas->where('nome', 'email_proposta')->first())value="{{  $entry->caracteristicas->where('nome', 'email_proposta')->first()->pivot->valor }}"@endif />
            </div>
          </div>  
        </div>
  
        <div class="form-group">
          <div class="col-md-12">
             
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-canais-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif
            
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>