<div class="panel panel-accordion panel-accordion-info">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Midia">
        <i class="fa fa-building"></i> Mídias e Redes Sociais
      </a>
    </h4>
  </div>
  <div id="collapse2Midia" class="accordion-body collapse">
    <div class="panel-body">
      <form id="midias-empreendimento" class="form-horizontal form-bordered">
        @if(isset($entry))
        <input type="hidden" name="id" value="{{ $entry->id }}">
        @endif
        
        <div class="form-group">
          <label for="Link - Tour Virtual" class="col-md-2 control-label">Link - Tour Virtual</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-circle-o-notch"></i>
              </span>
              <input class="form-control" type="text" name="link_tour" @if (isset($entry) && $entry->caracteristicas->where('nome', 'link_tour')->first())value="{{  $entry->caracteristicas->where('nome', 'link_tour')->first()->pivot->valor }}"@endif>
            </div>
          </div> 
        </div>

        <div class="form-group">
          <label for="Vídeo" class="col-md-2 control-label">Vídeo</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-caret-square-o-right"></i>
              </span>
              <input class="form-control" type="text" name="video" @if (isset($entry) && $entry->caracteristicas->where('nome', 'video')->first())value="{{  $entry->caracteristicas->where('nome', 'video')->first()->pivot->valor }}"@endif>
            </div>
          </div>  
        </div>

        <div class="form-group">

          <label for="Instagram" class="col-md-2 control-label">Instagram</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-instagram"></i>
              </span>
              <input class="form-control" type="text" name="instagram_empreendimento" @if (isset($entry) && $entry->caracteristicas->where('nome', 'instagram_empreendimento')->first())value="{{  $entry->caracteristicas->where('nome', 'instagram_empreendimento')->first()->pivot->valor }}"@endif>
            </div>
          </div> 

          <label for="Facebook" class="col-md-2 control-label">Facebook</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-facebook-square"></i>
              </span>
              <input class="form-control" type="text" name="facebook_empreendimento" @if (isset($entry) && $entry->caracteristicas->where('nome', 'facebook_empreendimento')->first())value="{{  $entry->caracteristicas->where('nome', 'facebook_empreendimento')->first()->pivot->valor }}"@endif>
            </div>
          </div> 

        </div>


        <div class="form-group">
          <div class="col-md-12">
            @if(Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
            <button class="btn btn-success salvar-dados" type="button" id="salvar-midias-empreendimento"><i class="fa fa-save"></i> Salvar dados</button>    
            @else 
            <button class="btn btn-success salvar-dados erro-permissao" type="button"><i class="fa fa-save"></i> Salvar dados</button> 
            @endif   
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>