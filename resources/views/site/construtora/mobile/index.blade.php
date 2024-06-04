@extends('site/layout_mobile')

@push('css')
<meta name='description' content="{{ $construtora->observacoes }}"/>
<meta property="og:description" content="{{ $construtora->observacoes }}" />

<meta name="twitter:image" content="{{ $construtora->getLogoUrl('260x260') }}">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:title" content="{{ $construtora->nome }}" />
<meta property="og:image" content="{{ $construtora->getLogoUrl('260x260') }}" />
<meta property="og:image:type" content="image/jpeg">
<meta property="og:image:width" content="1067">
<meta property="og:image:height" content="600">
<meta property="og:type" content="website">
@endpush

@push('js_footer')

@endpush

@push('js_header')

@endpush

@section('content')
  <!-- Main Content -->
  <div class="content-container-busca animated fadeInUp">
    @if($empreendimentos->count() > 0)
      <div class="page-header-container animated fadeInRight">
        <span class="pra-title">
          Sua Busca retornou:
        </span>
        <h2 class="page-title">
          @if($empreendimentos->count() > 1)
            <h2>{{ $empreendimentos->count() }} empreendimentos </h2>
          @else
            <h2>{{ $empreendimentos->count() }} empreendimento </h2>
          @endif
        <div class="redline"></div>
      </div>
    @else
      <div class="page-header-container animated fadeInRight">
        <span class="pra-title">
          Em breve! Novos empreendimentos.
        </span>
        <h2 class="page-title"></h2>
        <div class="redline"></div>
      </div>
    @endif

    <div class="entry-main01 animated fadeInUp">
      <div class="box-contato-construtora">
        <div class="topo-construtora">
          <div class="stand-vendas">Vendas</div>
          <div class="logo-construtora">
            <img src="{{ $construtora->getLogoUrl('125x95') }}" alt="{{ $construtora->nome_abreviado }}" />
          </div>

          <div class="mapa-construtora">       
            @php
              $endereco_destino = null;

              if ($construtora->endereco) {
                $e = $construtora->endereco;
                $endereco_destino = "{$e->logradouro} {$e->numero} {$e->bairro} {$e->bairro} {$e->cidade->nome} {$e->cidade->estado->nome}";
              }            
            @endphp
            <a href="https://maps.google.com?saddr=Current+Location&daddr={{ $endereco_destino }}">
              <img src="/site/m/images/banners/como-chegar-construtora.png" alt="{{ $construtora->nome_abreviado }}" />
            </a>
          </div>

        </div>

        <div class="botoes">

          <div class="ligar-construtora">
            @if($construtora->telefone)
            <a href="tel:{{ $construtora->telefone }}" onclick="GravarCliquetel(); return false;">
              <img class="responsive" src="/site/m/images/banners/construtora-ligar.png" alt="{{ $construtora->nome_abreviado }}" />
            </a>
            @elseif($construtora->celular_atendimento)
            <a href="tel:{{ $construtora->celular_atendimento }}" onclick="GravarCliquetel(); return false;">
              <img class="responsive" src="/site/m/images/banners/construtora-ligar.png" alt="{{ $construtora->nome_abreviado }}" />
            </a>
            @else
            <img class="responsive" src="/site/m/images/banners/construtora-ligar-off.png" alt="{{ $construtora->nome_abreviado }}" />
            @endif
          </div>

          <div class="chat-construtora">
            @if($construtora->whatsapp)
            <a href="https://api.whatsapp.com/send?phone=55{{ $construtora->whatsapp }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank">
              <img class="responsive" src="/site/m/images/banners/construtora-chat.png" alt="{{ $construtora->nome_abreviado }}" />
            </a>
            @else
              <img class="responsive" src="/site/m/images/banners/construtora-chat-off.png" alt="{{ $construtora->nome_abreviado }}" />
            @endif
          </div>

        </div>
      </div>
    </div>
  
    @include('site/busca/mobile/lista')

    <div class="clear"></div>
  </div>
  <!-- End Main Content -->
@endsection