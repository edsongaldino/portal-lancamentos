<div class="panel panel-accordion panel-accordion-green">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Four">
        <i class="fa fa-cloud"></i> Canais de Atendimento
      </a>
    </h4>
  </div>
  <div id="collapse2Four" class="accordion-body collapse">
  <div class="panel-body">
      <form id="dados-canais-atendimento" class="form-horizontal form-bordered">
        
        <div class="form-group">

          <label for="telefoneCentral" class="col-md-2 control-label"><strong>Telefone</strong><br/>(Fixo Local)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              <input class="form-control celular" id="phone" data-plugin-masked-input="" data-input-mask="(99) 9999-9999" placeholder="(12) 1234-1234" type="text" name="telefone" value="@if ($construtora){{ $construtora->telefone }}@endif" maxlength="15" autocomplete="off">
            </div>
          </div>

          <label for="telefoneCentral" class="col-md-2 control-label">Telefone (NUN)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              <input class="form-control" id="phone" type="text" name="telefone_nun" value="@if ($construtora){{ $construtora->telefone_nun }}@endif" maxlength="15" autocomplete="off">
            </div>
          </div>

        </div>

        <div class="form-group">

          <label for="telefoneCentral" class="col-md-2 control-label">Celular (Atendimento)</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-phone"></i>
              </span>
              <input class="form-control celular" id="phone" data-plugin-masked-input="" data-input-mask="(99) 99999-9999" placeholder="(12) 1234-1234" type="text" name="celular_atendimento" value="@if ($construtora){{ $construtora->celular_atendimento }}@endif" maxlength="15" autocomplete="off">
            </div>
          </div>

          <label for="telefoneCentral" class="col-md-2 control-label">Whatsapp</label>
          <div class="col-md-4">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-whatsapp"></i>
              </span>
              <input class="form-control" placeholder="" type="text" name="whatsapp" value="@if ($construtora){{ $construtora->whatsapp }}@endif" maxlength="15" autocomplete="off">
            </div>
          </div>

        </div>

        <div class="form-group">
          <label for="Link Chat" class="col-md-2 control-label"><strong>E-mail</strong><br/>(Principal)</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-envelope"></i>
              </span>
              <input name="email" id="tags-input" data-role="tagsinput" data-tag-class="label label-primary" class="form-control" value="@if ($construtora){{ $construtora->email }}@endif" />
            </div>
          </div>  
        </div>

        <div class="form-group">
          <div class="col-md-12">
            <button class="btn btn-success salvar-dados" type="button" id="salvar-dados-canais-atendimento"><i class="fa fa-save"></i> Salvar Dados</button>    
          </div>
        </div>
        
      </form>
    </div>
  </div>
</div>