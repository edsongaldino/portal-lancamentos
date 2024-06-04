<div class="panel panel-accordion panel-accordion-info">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2Two">
        <i class="fa fa-cogs"></i> Informações da Construtora
      </a>
    </h4>
  </div>
  <div id="collapse2Two" class="accordion-body collapse">
    <div class="panel-body">
      <form id="dados-construtora" class="form-horizontal form-bordered">

        <div class="form-group">
          <label class="col-md-2 control-label">CNPJ</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-asterisk"></i>
              </span>
              <input name="cnpj" value="@if ($construtora) {{ $construtora->cnpj }} @endif"  type="text" placeholder="CNPJ" class="form-control cnpj">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Razão Social</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-bank"></i>
              </span>
              <input name="razao_social" value="@if ($construtora) {{ $construtora->razao_social }} @endif" type="text" placeholder="Razão Social" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Fantasia</label>
          <div class="col-md-10">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-bookmark"></i>
              </span>
              <input name="nome" value="@if ($construtora) {{ $construtora->nome }} @endif" type="text" placeholder="Nome abreviado" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Fundação</label>
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              <select class="form-control" name="mes">
                <option>Escolha o mês</option>
                <option value="1" @if(isset($construtora) && $construtora->mes_fundacao == "1")selected="true"@endif>Janeiro</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "2")selected="true"@endif value="2">Fevereiro</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "3")selected="true"@endif value="3">Março</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "4")selected="true"@endif value="4">Abril</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "5")selected="true"@endif value="5">Maio</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "6")selected="true"@endif value="6">Junho</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "7")selected="true"@endif value="7">Julho</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "8")selected="true"@endif value="8">Agosto</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "9")selected="true"@endif value="9">Setembro</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "10")selected="true"@endif value="10">Outubro</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "11")selected="true"@endif value="11">Novembro</option>
                <option @if(isset($construtora) && $construtora->mes_fundacao == "12")selected="true"@endif value="12">Dezembro</option>
              </select>              
            </div>
          </div>
          <div class="col-md-5">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </span>
              <select class="form-control" name="ano">
                <option>Escolha o ano</option>
                @php
                  $year = date("Y");
                  $anos = '';
                  for ($i = 1945; $i < $year ; $i++) {
                    $selected = $construtora->ano_fundacao == $i ? "selected='true'" : '';
                    $anos .= "<option ". $selected ." value='". $i . "'>". $i ."</option>";
                  }
                @endphp
                {!! $anos !!}
              </select>              
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">IE</label>
          <div class="col-md-8">
            <div class="input-group">
              <span class="input-group-addon">
                <i class="fa fa-barcode"></i>
              </span>
              <input name="ie" value="@if ($construtora) {{ $construtora->ie }} @endif" type="text" placeholder="IE" class="form-control">
            </div>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-2 control-label">Logo da Construtora</label>
          <div class="col-md-10">
            <div class="container">
              <div class="avatar-upload">
                <div class="avatar-edit">
                  <input name="logo" type='file' class="imagem" id="campoLogoConstrutora" data-id="#logoConstrutora"/>
                  <label for="campoLogoConstrutora"></label>
                </div>
                @if ($construtora && $construtora->getLogoUrl())
                <div class="avatar-preview">
                  <div id="logoConstrutora" style="background-image: url( {{ url($construtora->getLogoUrl()) }});">
                  </div>
                </div>
                @else
                <div class="avatar-preview">
                  <div id="logoConstrutora">
                  </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="form-group">          
          <label class="col-md-2 control-label" for="textareaDefault">Observações</label>
          <div class="col-md-10">
            <p>              
              <code>Número máximo de caracteres</code> é 280.
            </p>
            <textarea data-item="alterar-caracteres" data-target="contar_observacoes" id="observacoes_construtora" name="observacoes" class="form-control" rows="3" data-plugin-maxlength maxlength="280">@if ($construtora) {{ $construtora->observacoes }} @endif</textarea>            
            <p>              
              <code>Qtde atual de caracteres:</code> é <span id="contar_observacoes" data-role="contar-caracteres" data-target="observacoes_construtora"></span>.
            </p>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <button class="btn btn-success" type="button" id="salvar-dados-construtora">Salvar dados</button>    
          </div>
        </div>
      </form>
    </div>
  </div>
</div>