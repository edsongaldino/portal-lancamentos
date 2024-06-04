<div class="row margin-top-90">
  <div class="col-xs-12">
    <h3 class="title-negative-margin">
      Fale com a construtora
    </h3>
    <div class="title-separator-primary"></div>
  </div>
</div>

<div class="row margin-top-15">
  <div class="col-xs-8 col-xs-offset-2 col-sm-3 col-sm-offset-0">
    <h5 class="subtitle-margin">
      Central de Vendas
    </h5>
    <h3 class="title-negative-margin">
      <i class="fa fa-phone"></i> 
      @if($empreendimento->getCaracteristica('telefone_central')) 
        {{ $empreendimento->getCaracteristica('telefone_central') }}  
      @elseif($empreendimento->construtora->telefone_nun)
        {{ $empreendimento->construtora->telefone_nun }} 
      @elseif($empreendimento->construtora->telefone) 
        {{ $empreendimento->construtora->telefone }}
      @else
        {{ $empreendimento->construtora->celular_atendimento }}
      @endif
    </h3>
    <a href="{{ $empreendimento->url_hotsite }}" class="agent-photo">
      <img src="{{ $empreendimento->construtora->getLogoUrl('260x260') }}" width="250" class="img-responsive" />
    </a>
    @if($empreendimento->construtora->ano_fundacao)
      <div class="fundacao" title="Ano de fundação da construtora">
        <i class="fa fa-calendar" aria-hidden="true"></i> 
        Fundada em {{ $empreendimento->construtora->ano_fundacao }}
      </div>
    @else
      <div class="fundacao" title="Tempo de mercado">
        <i class="fa fa-calendar" aria-hidden="true"></i> 
        Fundada à {{ $empreendimento->construtora->tempo_mercado }} anos
      </div>
    @endif
  </div>
  <div class="col-xs-12 col-sm-9 contato-construtora">
    <div class="agent-social-bar">
      <div class="pull-left">
        <span class="agent-icon-circle">
          <i class="fa fa-envelope fa-sm"></i>
        </span>
        <span class="agent-bar-text">{{ $empreendimento->construtora->email }}</span>
      </div>
      <div class="pull-right">
        <div class="pull-right">
          <a class="agent-icon-circle" href="{{ $empreendimento->construtora->facebook }}" target="_blank">
            <i class="fa fa-facebook"></i>
          </a>
        </div>
        <div class="pull-right">
          <a class="agent-icon-circle icon-margin" href="{{ $empreendimento->construtora->twitter }}" target="_blank">
            <i class="fa fa-twitter"></i>
          </a>
        </div>
        <div class="pull-right">
          <a class="agent-icon-circle icon-margin" href="{{ $empreendimento->construtora->instagram }}" target="_blank">
            <i class="fa fa-instagram"></i>
          </a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <form id="form-contato-construtora-rodape">
      <input name="nome" type="text" class="input-long main-input" placeholder="Nome completo" value="" required/>

      <input name="telefone" type="text" class="input-telefone main-input telefone" placeholder="Telefone" value="" required/>

      <input name="email" type="email" class="input-email main-input" placeholder="E-mail" value="" required/>

      <select name="previsao" class="input-short5 main-input" required>
        <option class="item" value="" selected="selected">Qual a sua previsão de compra?</option>
        <option class="item" value="Imediata">Imediata</option>
        <option class="item" value="Até 90 dias">Até 90 dias</option>
        <option class="item" value="6 meses à 1 ano">6 meses à 1 ano</option>
        <option class="item" value="1 ano ou mais">1 ano ou mais</option>
      </select>

      <select name="interesse" class="input-short5 main-input" required>
        <option class="item" value="" selected="selected">O que mais te agradou neste produto?</option>
        <option class="item" value="Preço">Preço</option>
        <option class="item" value="Localização">Localização</option>                                
        <option class="item" value="Área de Lazer">Área de Lazer</option>
        <option class="item" value="Planta do imóvel">Planta do imóvel</option>
        <option class="item" value="Previsão de entrega">Previsão de entrega</option>
      </select>

      <select name="renda" class="input-short6 main-input" required>
        <option class="item" value="" selected="selected">Qual a sua renda? R$</option>
        <option class="item" value="Até 3.000,00">Até 3.000</option>
        <option class="item" value="de 3.000 à 5.000">de 3.000 à 5.000</option>
        <option class="item" value="de 5.000 à 7.000">de 5.000 à 7.000</option>
        <option class="item" value="de 7.000 à 10.000">de 7.000 à 10.000</option>
        <option class="item" value="de 10.000 à 15.000">de 10.000 à 15.000</option>
        <option class="item" value="Acima de 15.000">Acima de 15.000</option>
      </select>

      <textarea name="mensagem" class="input-full agent-textarea main-input" placeholder="Mensagem">Olá, tenho interesse no empreendimento {{ $empreendimento->nome }}. Aguardo o contato. Obrigado.</textarea>      

      <div class="loadingImg_Botton" style="display:none;"><img src="/site/imagens/loader2.gif" alt=""></div>

      <div class="form-submit-bottom enviar-formulario" style="display:block;">
        <a href="javascript:void(0);" class="button-primary pull-right enviar-novo botao-enviar" data-form="#form-contato-construtora-rodape">
          <span>Enviar</span>
          <div class="button-triangle"></div>
          <div class="button-triangle2 novo"></div>
          <div class="button-icon"><i class="fa fa-paper-plane icon-send-novo"></i></div>
        </a>
        <div class="clearfix"></div>
      </div>


      <input type="hidden" placeholder="" name="empreendimento_id" value="{{ $empreendimento->id }}">  
    </form>
  </div>
</div>