<!-- Content Contato -->
<section id="conteudo-contato">
  <div class="widget-box">
    <h3 class="widget-title">
      <span class="perfil">Fale agora com a construtora</span>
    </h3>
  </div>
  <!-- Funções Como Chegar e Ligar -->  
  <div class="entry-main01 animated fadeInUp">
    <div class="box-contato-construtora">
      <div class="topo-construtora">
        <div class="stand-vendas">
          Vendas
        </div>
        <div class="logo-construtora">
          <img src="{{ $empreendimento->construtora->getLogoUrl('125x95') }}" alt="{{ $empreendimento->construtora->nome_abreviado }}"/>
        </div>
        <div class="mapa-construtora">       
          @php
            $endereco = null;

            if ($empreendimento->construtora->endereco) {
              $e = $empreendimento->construtora->endereco;
              $endereco = "{$e->logradouro} {$e->numero} {$e->bairro->nome} {$e->cidade->nome} {$e->cidade->estado->nome}";
            }            
          @endphp

          <a href="https://maps.google.com?saddr=Current+Location&daddr={{ $endereco }}">
            <img src="/site/m/images/banners/como-chegar-construtora.png" alt="{{ $empreendimento->construtora->nome_abreviado }}" /></a>
        </div>
      </div>        
      <div class="botoes">
        <div class="ligar-construtora">
          <a href="#openModal" id="ModalLigar">
            <img class="responsive" src="/site/m/images/banners/construtora-ligar.png" alt="{{ $empreendimento->construtora->nome_abreviado }}" />
          </a>
        </div>

        <div class="chat-construtora">
          <a href="#openModal" id="ModalChat">
            <img class="responsive" src="/site/m/images/banners/construtora-chat.png" alt="{{ $empreendimento->construtora->nome_abreviado }}" />
          </a>
        </div>

      </div>
    </div>
  </div>

  <div class="content-container animated fadeInUp">                  
    <div class="entry-main">
      <div class="entry-content"> 
        <form id="form-contato-construtora-rodape">
          <div class="input-field">
            <span class="icons icone_campo">
              <i class="fa fa-user"></i>
            </span>
            <input name="nome" type="text" class="input-form with-icons input-font-maior" placeholder="Nome completo" value="" required/>
          </div>

          <div class="input-field">
            <span class="icons icone_campo">
              <i class="fa fa-envelope"></i>
            </span>
            <input type="email" name="email" id="email" placeholder="E-mail" class="input-form with-icons input-font-maior" required="required" value="">
          </div>

          <div class="input-field">
            <span class="icons icone_campo">
              <i class="fa fa-phone"></i>
            </span>
            <input type="text" placeholder="Telefone" name="telefone" id="telefone_form" class="input-form with-icons telefone phone" maxlength="16" required="required" value="">
          </div>

          <div class="input-field">
            <span class="icons">
              <i class="fa fa-sort-desc"></i>
            </span>
            <select class="search-box__combo js-businessSelect" name="previsao" id="previsao" required="required">
              <option class="item" value="" selected="selected">Qual a sua previsão de compra?</option>
              <option class="item" value="Imediata">Imediata</option>
              <option class="item" value="Até 90 dias">Até 90 dias</option>
              <option class="item" value="6 meses à 1 ano">6 meses à 1 ano</option>
              <option class="item" value="1 ano ou mais">1 ano ou mais</option>
            </select>
          </div>

          <div class="input-field">
            <span class="icons">
              <i class="fa fa-sort-desc"></i>
            </span>
            <select class="search-box__combo js-businessSelect" name="interesse" id="interesse" required="required">
              <option class="item" value="" selected="selected">O que mais te agradou neste produto?</option>
              <option class="item" value="Preço">Preço</option>
              <option class="item" value="Localização">Localização</option>                                
              <option class="item" value="Área de Lazer">Área de Lazer</option>
              <option class="item" value="Planta do imóvel">Planta do imóvel</option>
              <option class="item" value="Previsão de entrega">Previsão de entrega</option>
            </select>
          </div>

          <div class="input-field">
            <span class="icons">
              <i class="fa fa-sort-desc"></i>
            </span>
            <select class="search-box__combo js-businessSelect" name="renda" id="renda" required="required">
              <option class="item" value="" selected="selected">Qual a sua renda? R$</option>
              <option class="item" value="Até 3.000,00">Até 3.000</option>
              <option class="item" value="de 3.000 à 5.000">de 3.000 à 5.000</option>
              <option class="item" value="de 5.000 à 7.000">de 5.000 à 7.000</option>
              <option class="item" value="de 7.000 à 10.000">de 7.000 à 10.000</option>
              <option class="item" value="de 10.000 à 15.000">de 10.000 à 15.000</option>
              <option class="item" value="Acima de 15.000">Acima de 15.000</option>
            </select>
          </div>

          <div class="input-field">
            <span class="icons">
              <i class="fa fa-comment"></i>
            </span>
            <textarea placeholder="Mensagem" name="mensagem" id="mensagem" class="input-form with-icons textarea" required="required">Olá, tenho interesse no empreendimento {{ $empreendimento->nome }}. Aguardo o contato. Obrigado.</textarea>
          </div>


          <div class="loadingImg_Mobile" style="display:none;"><img src="/site/imagens/loader2.gif" alt=""></div>

          <div class="button-field btn-enviar-mobile" style="display:block;">
            <button type="button" data-form="#form-contato-construtora-rodape" class="button-form envia-form botao-enviar">Enviar</button>
          </div>

          <input type="hidden" placeholder="" name="empreendimento_id" value="{{ $empreendimento->id }}">  
        </form>              
      </div>
    </div>
  </div>
</section>


<!-- /Content Contato -->