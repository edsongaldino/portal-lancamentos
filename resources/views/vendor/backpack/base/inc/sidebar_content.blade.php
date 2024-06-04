@if (get_construtora_id())
  <li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>Início</span></a></li>
@endif

@php
    $construtora_id = get_construtora_id();

    if (isAdmin()) {
      $construtora_id = $construtora_id ?? 1;
    }
@endphp

@if (isAdmin())
  <li class="nav-parent">
    <a href="#"><i class="fa fa-cogs"></i> <span>Administrativo</span></a>
    <ul class="nav nav-children">
      <li><a href="{{ backpack_url('assinatura') }}"><i class="fa fa-money"></i> <span>Assinaturas</span></a></li>
      <li><a href="{{ backpack_url('modalidade') }}"><i class="fa fa-list-ul"></i> <span>Modalidades</span></a></li>
      <li><a href="{{ backpack_url('tipoconstrutora') }}"><i class="fa fa-columns"></i> <span>Tipo Construtora</span></a></li>
      <li><a href="{{ backpack_url('caracteristica') }}"><i class="fa fa-puzzle-piece"></i> <span>Características</span></a></li>
      <li><a href="{{ backpack_url('log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
      <li class="nav-parent">
        <a href="#"><i class="fa fa-map"></i> <span>Localidades</span></a>
        <ul class="nav nav-children">
          <li><a href="{{ backpack_url('estado') }}"><i class="fa fa-map"></i> <span>Estados</span></a></li>
          <li><a href="{{ backpack_url('cidade') }}"><i class="fa fa-map"></i> <span>Cidades</span></a></li>
          <li><a href="{{ backpack_url('bairro') }}"><i class="fa fa-map"></i> <span>Bairros</span></a></li>
        </ul>
      </li>
    </ul>
   </li>
   <li><a href="{{ backpack_url('construtora') }}"><i class="fa fa-bank"></i> <span>Construtoras</span></a></li>
   <li><a href="{{ route('publicacoes') }}"><i class="fa fa-paper-plane-o"></i> <span>Publicações / Artigos</span></a></li>
@endif

<li><a href="{{ backpack_url('empreendimentos') }}"><i class="fa fa-building"></i> <span>Empreendimentos</span></a></li>

@if (Auth::user()->getRoleNames() <> '["Corretor"]')
<li><a href="{{ backpack_url('leads') }}"><i class="fa fa-comments"></i> <span>Leads</span></a></li>
<!--<li><a href="{{ backpack_url('ofertas') }}"><i class="fa fa-shopping-cart"></i> <span>Ofertas</span></a></li>-->

@if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())

<li class="nav-parent">
  <a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Comercial</span></a>
  <ul class="nav nav-children">
    <li><a href="{{ route('tabela-vendas', $construtora_id) }}"><i class="fa fa-shopping-bag" aria-hidden="true"></i> <span>Tabela de Vendas</span></a></li>
    <li><a href="{{ route('negociar-unidades', $construtora_id) }}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Negociar Unidades</span></a></li>
  </ul>
</li>

@endif

<li><a href="{{ backpack_url('estatisticas') }}"><i class="fa fa-bar-chart-o"></i> <span>Estatísticas</span></a></li>
@endif

@if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
<li class="nav-parent">
  <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i> <span>Integrações</span></a>
  <ul class="nav nav-children">
    <li><a href="{{ route('rede-domus') }}"><i class="fa fa-university" aria-hidden="true"></i> <span>Rede Domus</span></a></li>
    <li><a href="{{ route('facilita') }}"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>Facilitá</span></a></li>
    <li><a href="{{ route('anapro') }}"><i class="fa fa-caret-right" aria-hidden="true"></i> <span>Anapro</span></a></li>
  </ul>
</li>
@endif

@if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
<li class="nav-parent">
  <a href="#"><i class="fa fa-money"></i> <span>Financeiro</span></a>
  <ul class="nav nav-children">
    @if (Auth::user()->getRoleNames() <> '["Marketing"]')
    <li><a href="{{ route('financeiro-construtora', $construtora_id) }}"><i class="fa fa-suitcase"></i> <span>Minhas vendas</span></a></li>
    @endif
    <li><a href="{{ route('meu-plano', $construtora_id) }}"><i class="fa fa-tags"></i> <span>Meu plano</span></a></li>
  </ul>
</li>
@endif

@if (isAdmin())
  <li class="nav-parent">
  	<a href="#"><i class="fa fa-group"></i> <span>Usuários, Grupos, Permissões</span></a>
  	<ul class="nav nav-children">
  	  <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
  	  <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Grupos</span></a></li>
  	  <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissões</span></a></li>
  	</ul>
  </li>
@endif

<li class="chat-suporte">
  <a href="https://api.whatsapp.com/send?phone=5565999859700&text=Ol%C3%A1%2C%20preciso%20de%20suporte%(PAINEL)!" target="_blank"><i class="fa fa-whatsapp"></i> <span>Suporte ONLINE</span></a>
</li>