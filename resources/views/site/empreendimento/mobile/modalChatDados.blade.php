<div id="openModal" class="modalDialog">
    <div class="modalAtendimento">
      <a href="#close" title="Close" class="close">X</a>

      @if(isset($viewCorretor))

        @if(Session::get('usuario.foto') <> null)
            <div class="icone-chat-modal"><img src="/uploads/{{ Session::get('usuario.foto') }}" alt="" class="img-responsive foto-user"></div>
        @else
            <div class="icone-chat-modal"><img src="{{ asset('corretor/app-assets/images/userFoto.png') }}" alt="" class="img-responsive foto-user"></div>
        @endif
        
      @else
        <div class="icone-chat-modal"><img src="/assets/images/chat-online.png" alt="" class="img-responsive"></div>
      @endif
      <div class="texto-chat-modal">Para iniciar o atendimento com o corretor, precisamos te conhecer</div>
      <form action="" id="modal-chat" name="modal-chat">
        <input type="text" class="form-control nome-modal" name="nome" id="nome" placeholder="Nome completo" required>
        <input type="text" class="form-control whatsapp-modal telefone" name="whatsapp" id="whatsapp" placeholder="Whatsapp" required>
        <input type="hidden" name="tipo_clique" id="tipo_clique" value="Whatsapp">
        <input type="hidden" name="empreendimento_id" id="empreendimento_id" value="{{ $empreendimento->id }}">

        <div class="loadingImg_Chat" style="display:none;"><img src="/site/imagens/loader2.gif" title="Loader" alt="Loader" width="50" height="50" class="center"></div>
        <button type="button" id="botaoContinuar" class="btn btn-primary continuar ChatMobileEnviar" style="display:block;"><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar</button>

      </form>

      @if($empreendimento->construtora->envio_lead == 'Ativo')
        <div class="link-whatsapp-mobile" style="display: none;">
        @if($empreendimento->getCaracteristica('whatsapp_atendimento'))
        <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->getCaracteristica('whatsapp_atendimento')) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
          <button type="button" class="btn btn-primary btn-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Atendimento Whatsapp</button>
        </a>
        @elseif($empreendimento->construtora->whatsapp)
        <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->construtora->whatsapp) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
          <button type="button" class="btn btn-primary btn-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Atendimento Whatsapp</button>
        </a>
        @else
        <a href="https://api.whatsapp.com/send?phone=5565999859238&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
          <button type="button" class="btn btn-primary btn-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Atendimento Whatsapp</button>
        </a>
        @endif
        </div>

        <div class="link-telefone-mobile" style="display: none;">

          @if($empreendimento->getCaracteristica('telefone_central'))
          <a href="tel:{{ $empreendimento->getCaracteristica('telefone_central') }}" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para a construtora</button>
          </a>
          @elseif($empreendimento->construtora->telefone_nun)
          <a href="tel:{{ $empreendimento->getCaracteristica('telefone_central') }}" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para a construtora</button>
          </a>
          @elseif($empreendimento->construtora->celular_atendimento)
          <a href="tel:{{ $empreendimento->construtora->telefone_nun }}" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para a construtora</button>
          </a>
          @elseif($empreendimento->construtora->telefone)
          <a href="tel:{{ $empreendimento->construtora->telefone }}" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para a construtora</button>
          </a>
          @else
          <a href="tel:65999859700" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar-off"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para a construtora</button>
          </a>
          @endif

        </div>
      @elseif(isset($empreendimento->costrutora->parceiros))

          <div class="link-whatsapp-mobile" style="display: none;">
            <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->costrutora->parceiros->telefone->first() ?? '65999859700') }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
              <button type="button" class="btn btn-primary btn-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Atendimento Whatsapp</button>
            </a>
          </div>

          <div class="link-telefone-mobile" style="display: none;">

            <a href="tel:{{ $empreendimento->costrutora->parceiros->telefone->first() ?? '65999859700' }}" onclick="GravarCliquetel(); return true;">
              <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para o corretor</button>
            </a>

          </div>
      @else
        <div class="link-whatsapp-mobile" style="display: none;">
            <a href="https://api.whatsapp.com/send?phone=5565999859700&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
            <button type="button" class="btn btn-primary btn-whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i> Atendimento Whatsapp</button>
            </a>
        </div>

        <div class="link-telefone-mobile" style="display: none;">

            <a href="tel:65999859700" onclick="GravarCliquetel(); return true;">
            <button type="button" class="btn btn-primary btn-ligar"><i class="fa fa-phone" aria-hidden="true"></i> Ligar para o corretor</button>
            </a>

        </div>
      @endif




    </div>
  </div>
