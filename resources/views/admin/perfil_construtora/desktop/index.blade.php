@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>{{ trans('backpack::base.my_account') }}</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>

      <li>
        <a href="{{ route('perfil-construtora') }}">Construtora</a>
      </li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')
<!-- start: page -->

<div class="row">

  @include('admin/financeiro/desktop/msg_bloqueio')
  
  @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
  @include('admin/oferta/desktop/banner_oferta')
  @endif

  <div class="col-md-4 col-lg-3">
    <section class="panel">
      <div class="panel-body">
        <div class="thumb-info mb-md">
          @if ($construtora && $construtora->getLogoUrl())
            <img src="{{ url($construtora->getLogoUrl()) }}" class="rounded img-responsive logo-construtora" alt="{{ $construtora->nome }}">
          @else
            <img src="{{ url('assets/images/user-sem-foto.jpg') }}" style="width: 100%;">
          @endif
          <div class="thumb-info-title">
            <span class="thumb-info-inner">{{ $construtora->nome }}</span>
            <span class="thumb-info-type"></span>
          </div>
        </div>

        <div class="widget-toggle-expand mb-md">
          <div class="widget-header">
            <h6>Complete seu perfil</h6>
            <div class="widget-toggle">+</div>
          </div>
          @php
          $percentual = 0;
          if ($construtora) {
            $percentual = percentual_perfil('construtora', $construtora->id);
          }
          @endphp
          <div class="widget-content-collapsed">
            <div class="progress progress-xs light">
              <div class="progress-bar" role="progressbar" aria-valuenow="{{ $percentual }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $percentual }}%;">
                {{ $percentual }}%
              </div>
            </div>
          </div>
          <div class="widget-content-expanded">
            <ul class="simple-todo-list">
              @foreach ($perfil as $item)
              <li @if ($item['completo'] == 'S')class="completed"@endif>{{ $item['nome'] }}</li>
              @endforeach                          
            </ul>
          </div>
        </div>

        <hr class="dotted short">

        @if ($construtora->observacoes)
          <h6 class="text-muted">Seu perfil profissional</h6>
          <p>{{ $construtora->observacoes }}</p>
        @endif

        <hr class="dotted short">

        <div class="social-icons-list">
          @if ($construtora && $construtora->facebook)
          <a rel="tooltip" data-placement="bottom" href="{{ $construtora->facebook }}" target="_blank" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
          @endif
          @if ($construtora && $construtora->twitter)
          <a rel="tooltip" data-placement="bottom" href="{{ $construtora->twitter }}" target="_blank" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
          @endif
          @if ($construtora && $construtora->instagram)
          <a rel="tooltip" data-placement="bottom" href="{{ $construtora->instagram }}" target="_blank" data-original-title="Instagram"><i class="fa fa-instagram"></i><span>Instagram</span></a>
          @endif
        </div>

      </div>
    </section>

  </div>
  <div class="col-md-8 col-lg-6">
    <div class="panel-group" id="accordion2">
      @include('admin.perfil_construtora.desktop.dados')
      @include('admin.perfil_construtora.desktop.endereco')
      @include('admin.perfil_construtora.desktop.canais_atendimento')
      @include('admin.perfil_construtora.desktop.redes_sociais')            
    </div>
  </div>
  <div class="col-md-12 col-lg-3">
    
    @if (isset($construtora))      
      @if ($construtora->acesso_domus == 'Sim')
        <a href="https://www.domusapp.com.br/sistema/login2.php?email={{ Auth::user()->email }}&hash={{ Auth::user()->password }}" class="btn btn-success btn-acessar-domus" target="_blank" rel="tooltip" data-original-title="Clique para acessar a Rede Domus">
        <i class="fa fa-university" aria-hidden="true"></i> Rede Domus - Acessar
        </a>
      @endif
    @endif

    <h4 class="mb-md">Informações da conta</h4>
    <ul class="simple-card-list mb-xlg">
      <li class="primary">
        <h3>{{ (isset($assinatura)) ? $assinatura->nome : null }}</h3>
        <p>Plano contratado</p>        
      </li>
      <li class="primary">
        @php
          $valor = 0;
          $valor_americano = 0;

          if (isset($assinatura)) {
            $valor = $assinatura->preco;  
            $valor_americano = $assinatura->getOriginal('preco');
          }
          
          if ($construtora->valor_mensal) {
            $valor = $construtora->valor_mensal;
            $valor_americano = $construtora->getOriginal('valor_mensal');
          }

          $unidades = total_unidades_construtora($construtora);
        @endphp

        <h3>R$ {{ $valor }}</h3>
        @if ($valor > 0 && $unidades > 0)
          <p style="color: yellow; font-weight: bold;">Você está pagando {{ number_format($valor_americano / $unidades, 2, ',', '.') }} por unidade</p>
        @endif
      </li>
      <li class="primary">
        <h3>{{ (isset($assinatura)) ? $assinatura->quantidade_produtos : null }}</h3>
        <p>Quantidade de produtos</p>
        
      </li>
      <li class="primary">
        <h3>{{ number_format($unidades, 0, '', '.') }}</h3>
        <p>Unidades disponíveis</p>
      </li>
    </ul>


    <section class="panel">
      <header class="panel-heading">
        <div class="panel-actions">
          @if (isset($construtora))
          @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
          <button type="button" data-titulo="Novo membro da equipe" data-method="get" data-url="{{ route('cadastrar-membro', $construtora->id) }}" data-botao="Cadastrar membro" data-toggle="modal" data-target="#membro" class="btn btn-success">
            <i class="fa fa-plus"></i>
          </button>
          @endif
          @endif
        </div>

        <h2 class="panel-title">
          <span class="label label-primary label-sm text-normal va-middle mr-sm">{{ count($equipe) ?: null }}</span>
          <span class="va-middle">
            Usuários da Empresa
          </span>
        </h2>
      </header>
      <div class="panel-body">               
        <div class="content">
          <ul class="simple-user-list">
            @if (isset($equipe))
            @foreach ($equipe as $integrante)
            @if ($integrante['id'] <> 1 && $integrante['id'] <> 2)
            <li>
              <div class="dados-usuario">
                <figure class="image rounded">
                  @if ($integrante['foto'])
                  <img width="35" height="35" src="{{ $integrante['foto'] }}" alt="{{ $integrante['name'] }}" class="img-circle">
                  @else
                  <img src="/assets/images/!sample-user.jpg" alt="{{ $integrante['name'] }}" class="img-circle">
                  @endif
                </figure>
                <span class="title">{{ $integrante['name'] }}</span>
                <span class="message truncate">
                  {{ (isset($integrante['cargo'])) ? $integrante['cargo'] : 'Nenhum cargo informado' }} 
                </span>
              </div>

              @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]'  || isAdmin())
              <div class="acoes-usuario">
                <button type="button" data-titulo="Alterar usuário ({{ $integrante['name'] }})" data-method="get" data-url="{{ route('alterar-membro', $integrante['id']) }}" data-botao="Atualizar membro" data-toggle="modal" data-target="#membro" class="btn btn-primary">
                  <i class="fa fa-pencil"></i>
                </button>
                <button type="button" data-url="{{ route('excluir-membro', $integrante['id']) }}" class="btn btn-danger excluir-membro">
                  <i class="fa fa-trash-o"></i>
                </button>
              </div>
              @endif
            </li>
            @endif
            @endforeach
            @endif
          </ul>
        </div>

      </div>

    </section>
  </div>
</div>
<!-- end: page -->

<div class="modal fade" id="membro" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="label"></h4>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/jquery-autosize/jquery.autosize.js"></script>
<script src="/assets/javascripts/perfil-construtora/index.js"></script>
<script src="/assets/javascripts/empreendimento/cep.js"></script>
<script src="/global/js/contar_caracteres/index.js"></script>
@endsection