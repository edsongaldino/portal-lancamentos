@php
  $marginTop = null;
  if($empreendimento->subtipo->id == 1 || $empreendimento->subtipo->id == 2) {
    $marginTop = 'margin-top-93';
  }                
@endphp

<div class="footer-descricao {{ $marginTop }}">
  @if ($empreendimento->id == 245)
  {{ $empreendimento->getCaracteristica('link_chat') }}  
  @elseif ($empreendimento->getCaracteristica('link_chat'))
  <a data-toggle="modal" data-target="#exampleModalCenter">
    <div class="chat-construtora"></div>
  </a>
  @endif
  
  @php 
    $previsao = get_previsao_entrega($empreendimento);
  @endphp

  @if ($previsao == 'Pronto')
    <a href="#" class="profile-detalhe-entrega" title="Previsão de entrega">
      <i class="fa fa-key" aria-hidden="true"></i> 
      PRONTO
    </a>
  @else
    <a href="#" class="profile-detalhe-entrega aguardando" title="Previsão de entrega">
      <i class="fa fa-calendar" aria-hidden="true"></i> 
      {{ $previsao }}
    </a>
  @endif
</div> 


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content desktop-modal">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="modal-chat" name="modal-chat">
          <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}" />
          <div class="titulo-chat">
            <div class="icone-chat"><img src="/assets/images/chat-online.png" alt="" class="img-responsive"></div>
            <div class="texto-chat">Para iniciar o atendimento com o corretor, precisamos te conhecer</div>
          </div>
          <input type="text" class="form-control nome-modal" name="nome" id="nome" placeholder="Nome completo" required>
          <input type="text" class="form-control whatsapp-modal telefone" name="whatsapp" id="whatsapp" placeholder="Whatsapp" required>
          <input type="hidden" name="tipo_clique" id="tipo_clique" value="Whatsapp">
          <input type="hidden" name="empreendimento_id" id="empreendimento_id" value="{{ $empreendimento->id }}">
        </form>
      </div>
      <div class="modal-footer">
        <a href="javascript:abrirChat('{{ $empreendimento->getCaracteristica('link_chat') }}')" class="btn btn-primary falar-com-corretor" style="display: none;"><i class="fa fa-weixin" aria-hidden="true"></i> Fale Agora com o Corretor</a>
        <button type="button" class="btn btn-primary modal-continuar continuar"><i class="fa fa-arrow-right" aria-hidden="true"></i> Continuar</button>
      </div>
    </div>
  </div>
</div>