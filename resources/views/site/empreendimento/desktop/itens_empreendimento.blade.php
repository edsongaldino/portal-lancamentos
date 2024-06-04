
    <div class="col-xs-12 col-lg-12">
    <div class="apartment-tabs">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        @php
        $modulo_itens_lazer = false;
        $itens_lazer = $empreendimento->itensLazer;
        $total_itens_lazer = $itens_lazer->count();
        if($total_itens_lazer>0):
        $modulo_itens_lazer = true;
        @endphp
        <li role="presentation" class="active">
          <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <span>Itens de Lazer</span>
            <div class="button-triangle2"></div>
          </a>
        </li>
        @php
        endif;
        @endphp
        <li role="presentation" class="@php if(empty($modulo_itens_lazer)): echo 'active'; endif; @endphp">
          <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            <span>Ficha Técnica</span>
            <div class="button-triangle2"></div>
          </a>
        </li>
        <li role="presentation">
          <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
            <span>Estágio da Obra</span>
            <div class="button-triangle2"></div>
          </a>
        </li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
        @php
        if($modulo_itens_lazer):
        @endphp
        @include('site/empreendimento/desktop/itens_lazer')
        @php
        endif;
        @endphp
        @include('site/empreendimento/desktop/ficha_tecnica')
        <div class="clearfix"></div>
      </div>
    </div>
  </div>