@extends('backpack::base.layout')
@section('content')

<header class="page-header">
  <h2>Empreendimento</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="/admin/dashboard">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Inicio</span></li>
      <li><span>Histórico de Alterações das Unidades</span></li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>

<!-- start: page -->
@if (count($historico))
<div class="timeline">
  <div class="tm-body">
    <div class="tm-title">
      <h3 class="h5 text-uppercase">Histórico de Alterações</h3>
    </div>

    <ol class="tm-items">
      @foreach($historico as $h)
      <li>
        <div class="tm-info">
          <div class="tm-icon"><i class="fa fa-star"></i></div>
          <time class="tm-datetime" datetime="{{ $h->created_at }}">
            <div class="tm-datetime-date">{{ data_br($h->created_at) }}</div>
            <div class="tm-datetime-time">{{ hora_br($h->created_at) }}</div>
          </time>
        </div>
        <div class="tm-box appear-animation" data-appear-animation="fadeInRight"data-appear-animation-delay="100">
          <p>
           <strong>Alvo das alterações:</strong> {{ $h->alvo }}
         </p>
         <div class="tm-meta">
          {!! $h->html  !!}
        </div>
      </div>
    </li>
    @endforeach
  </ol>        
</div>
</div>
@else
  <h1>Nenhuma alteração foi encontrada</h1>
@endif

<!-- end: page -->

@endsection