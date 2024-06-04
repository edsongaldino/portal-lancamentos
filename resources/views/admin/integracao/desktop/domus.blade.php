@extends('backpack::layout')
@section('header')
<header class="page-header">
  <h2>Integração - Rede Domus</h2>
  
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>
      
      <li>
        <a href="{{ route('rede-domus') }}">Integração Rede Domus</a>
      </li>
    </ol>
    
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')

<!-- start: page -->

<div class="row">
  <div class="col-md-4 col-lg-3">
    <section class="panel">
      <div class="panel-body">
        <div class="thumb-info mb-md">
          <img src="{{ url('assets/images/rede-domus.jpg') }}" style="width: 100%;">
        </div>

        <!--
        <div class="widget-toggle-expand mb-md">
          <div class="widget-header">
            <h6>Conheça a Rede Domus</h6>
            <div class="widget-toggle">+</div>
          </div>
          <div class="widget-content-expanded">
            <ul class="simple-todo-list">
              <li class="completed">Eventos e Ofertas</li> 
              <li class="completed">Rede de Corretores e Imobiliárias</li>                       
            </ul>
          </div>
        </div>

        <hr class="dotted short">

        <p>App projetado exclusivamente para integrar construtoras, incorporadoras, imobiliárias e corretores</p>
        
        <hr class="dotted short">

        <div class="social-icons-list">
          <a rel="tooltip" data-placement="bottom" href="https://www.facebook.com/rede_domus" target="_blank" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
          <a rel="tooltip" data-placement="bottom" href="https://twitter.com/rede_domus" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
          <a rel="tooltip" data-placement="bottom" href="https://www.instagram.com/rede_domus/" target="_blank" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>

        </div>
        -->
        
        @if (isset($construtora))      
        @if ($construtora->acesso_domus == 'Sim')
          <div class="titulo-conexao-on">Sua conexão está ativa!</div>
          <a href="#" data-id="{{ $construtora->id }}" data-status="Não" class="remover-integracao-domus"><div class="titulo-conexao-remover">Remover integração</div></a> 
        @else
          <div class="titulo-conexao-off">Sua conexão está desativada!</div>
          <a href="#" data-id="{{ $construtora->id }}" data-status="Sim" class="ativar-integracao-domus"><div class="titulo-conexao-ativar">Ativar integração</div></a>
        @endif
      @endif
                          
      </div>
    </section>

  </div>
  <div class="col-md-8 col-lg-6">
      
    @if (isset($construtora))      
      @if ($construtora->acesso_domus == 'Sim')
        <div class="alert alert-success fade in nomargin">
          <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
          <h4>Parabéns!</h4>
          <p>Sua construtora ja está conectada à Rede Domus. Para acessar, baixe o APP ou entre em <a href="https://www.domusapp.com.br/sistema/login2.php?email={{ Auth::user()->email }}&hash={{ Auth::user()->password }}" target="_blank">www.domusapp.com.br</a></p>
          <p>
            <a href="https://www.domusapp.com.br/sistema/login2.php?email={{ Auth::user()->email }}&hash={{ Auth::user()->password }}" target="_blank" class="btn btn-danger mt-xs mb-xs"><i class="fa fa-university" aria-hidden="true"></i> Acessar Rede Domus</a>
          </p>
        </div>
      @endif
    @endif
    
    <div class="tabs">
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#rededomus" data-toggle="tab" aria-expanded="true"><i class="fa fa-university" aria-hidden="true"></i> A Rede Domus</a>
        </li>
        <li class="">
          <a href="#comunicacao" data-toggle="tab" aria-expanded="true"><i class="fa fa-weixin" aria-hidden="true"></i> Comunicação</a>
        </li>
        <li class="">
          <a href="#integracao" data-toggle="tab" aria-expanded="false"><i class="fa fa-share-alt" aria-hidden="true"></i> Compartilhamento</a>
        </li>
        <li class="">
          <a href="#vendas" data-toggle="tab" aria-expanded="false"><i class="fa fa-rocket" aria-hidden="true"></i> Publicações</a>
        </li>
      </ul>
      <div class="tab-content">

        <div id="rededomus" class="tab-pane active">
          <div class="row box-integracao">
            <div class="col-md-4"><img src="https://domusapp.com.br/images/informacao.png" alt="" class="img-responsive"></div>
            <div class="col-md-8">
              <p class="subtitulo-integracao">Parceria com Imobiliárias e corretores</p>
              <p>Os parceiros tem acesso a todo o conteúdo e informações dos seus produtos á venda. são mais de 1.300 corretores e 100 imobiliárias conectadas á rede.</p>
              <p>Queremos facilitar a vida das imobiliárias e corretores que comercializam  lançamentos imobiliários, a rede integra produtos á venda na planta, em obra ou prontos para morar de construtoras e incorporadoras conectadas.</p>
            </div>
          </div>
        </div>

        <div id="comunicacao" class="tab-pane">
          <div class="row box-integracao">
            <div class="col-md-4"><img src="https://domusapp.com.br/images/graphic.png" alt="" class="img-responsive"></div>
            <div class="col-md-8">
              <p class="subtitulo-integracao">Seus parceiros conectados em tempo real</p>
              <p>Comunicação rápida entre os coordenadores de venda e parceiros da rede Domus</p>
              <p>Além das informações completas dos empreendimentos publicados na rede, os parceiros falam diretamente com o coordenador ou gerente de vendas dos produtos publicados; comunicação por E-mail, telefone ou WhatsApp.</p>
            </div>
          </div>
        </div>

        <div id="integracao" class="tab-pane">
          <div class="row box-integracao">
            <div class="col-md-4"><img src="https://domusapp.com.br/images/compartilhamento.png" alt="" class="img-responsive"></div>
            <div class="col-md-8">
              <p class="subtitulo-integracao">O Lançamentos Online compartilha o conteúdo dos seus produtos na rede Domus</p>
              <p>Ao publicar os empreendimentos no portal, o banco de dados é integrado á rede Domus; todas as informações, imagens, plantas, vídeos, descrição, disponibilidade e valores são sincronizados e fornecidos aos parceiros que navegam na rede. </p> 
              <p>O acesso á rede é gratuito, corretores e imobiliárias não pagam para ter acesso.</p>
            </div>
          </div>        
        </div>

        <div id="vendas" class="tab-pane">
          <div class="row box-integracao">
            <div class="col-md-4"><img src="/assets/images/icone-impulsionar.png" alt="" class="img-responsive"></div>
            <div class="col-md-8">
              <p class="subtitulo-integracao">Na rede Domus você pode publicar eventos, ofertas ou comunicados para todos os Parceiros</p>
              <p>Disparos inteligentes podem ser enviados pela rede Domus, defina o conteúdo, faça a inclusão das mídias e envie para todo os membros; Informe promoções, meeting de lançamentos, campanhas e comunicados importantes.</p>
            </div>
          </div>
        </div>
      </div>
    </div>


    <div class="panel panel-accordion">
      <div class="panel-heading">
        <h4 class="panel-title title-users">
        <i class="fa fa-user" aria-hidden="true"></i> Marque os usuários que serão mostrados no perfil da construtora na Rede Domus
        </h4>
      </div>
      <div id="collapse1One" class="accordion-body collapse in">
        <div class="panel-body">

          @if (isset($equipe))
            @foreach ($equipe as $integrante)
              @if ($integrante['id'] <> 1 && $integrante['id'] <> 2)
              <header class="panel-heading bg-default">

                <div class="widget-profile-info">
                  <div class="profile-picture">
                    @if ($integrante['foto'])
                    <img src="{{ $integrante['foto'] }}" alt="{{ $integrante['name'] }}" class="img-circle">
                    @else
                    <img src="/assets/images/!sample-user.jpg" alt="{{ $integrante['name'] }}" class="img-circle">
                    @endif

                  </div>
                  <div class="profile-info">
                    <h4 class="name text-semibold">{{ $integrante['name'] }}</h4>
                    <h5 class="role">{{ (isset($integrante['cargo'])) ? $integrante['cargo'] : 'Nenhum cargo informado' }} </h5>

                    @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
                    <div class="profile-footer">
                      <div rel="tooltip" data-id="{{ $integrante['id'] }}" data-perfil="Não Integrado" class="btn @if($integrante['perfil_domus'] == 'Não Integrado'){{ 'btn-danger' }}@else{{ 'btn-default integrar-usuario-domus' }}@endif" data-original-title="Marcando essa opção o usuário será integrado mas não estará visível aos seus parceiros">Ocultar</div>
                      <div rel="tooltip" data-id="{{ $integrante['id'] }}" data-perfil="Integrado" class="btn @if($integrante['perfil_domus'] == 'Integrado'){{ 'btn-success' }}@else{{ 'btn-default integrar-usuario-domus' }}@endif" data-original-title="Marcando essa opção o usuário será integrado e estará visível à todos os seus parceiros">Mostrar</div>
                    </div>
                    @else
                    <div class="profile-footer">
                      <div rel="tooltip" data-perfil="Não Integrado" class="btn @if($integrante['perfil_domus'] == 'Não Integrado'){{ 'btn-danger' }}@endif" data-original-title="Marcando essa opção o usuário será integrado mas não estará visível aos seus parceiros">Ocultar</div>
                      <div rel="tooltip" data-perfil="Integrado" class="btn @if($integrante['perfil_domus'] == 'Integrado'){{ 'btn-success' }}@endif" data-original-title="Marcando essa opção o usuário será integrado e estará visível à todos os seus parceiros">Mostrar</div>
                    </div>
                    @endif
                  </div>
                </div>

              </header>
              @endif
            @endforeach
          @endif

        </div>
      </div>
    </div>
      
  </div>
  <div class="col-md-12 col-lg-3">

    <div class="thumb-info mb-md">
      <img src="{{ url('assets/images/app-rede-domus.png') }}" style="width: 100%;">
    </div>
    <!--
    <h4 class="mb-md">Informações</h4>
    <ul class="simple-card-list mb-xlg">
      <li class="primary">
        <h3><i class="fa fa-university" aria-hidden="true"></i> 162</h3>
        <p>Imobiliárias cadastradas</p>        
      </li>
      <li class="primary">
          <h3><i class="fa fa-users" aria-hidden="true"></i> 1.296</h3>
          <p style="color: yellow; font-weight: bold;">Corretores conectados</p>
      </li>
      <li class="primary">
        <h3><i class="fa fa-building" aria-hidden="true"></i> 164</h3>
        <p>Produtos sendo comercializados</p>
      </li>
     
    </ul>
    -->

  </div>
</div>
<!-- end: page -->
<script src="/assets/vendor/ios7-switch/ios7-switch.js"></script>

@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/css/select2.css" />
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush

@push('after_scripts')
    <script src="/assets/javascripts/integracao/index.js"></script>
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/assets/javascripts/ui-elements/examples.modals.js"></script>
@endpush