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
        <a href="{{ route('perfil') }}">Meu perfil</a>
      </li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')

<div class="col-sm-12">
    <div class="row m-b-10">
        <div class="col-sm-3 hidden-print with-border">
          <button 
            class="btn btn-lg btn-primary btn-oferta-add" 
            data-backdrop="static" 
            data-keyboard="false"
            data-toggle="modal" 
            data-target="#oferta" 
            data-url="{{ route('nova-oferta') }}"
            data-method="GET"
          >
            <i class="fa fa-plus-square"></i> Adicionar oferta
          </button>
        </div>

        <div class="col-sm-9">
          <div class="link-compartilhamento">
            <div class="texto-compartilhamento" rel="tooltip" data-original-title="Copie e compartilhe o link de suas ofertas!"></div>

            <div class="input-group mb-md box-url-oferta">
              <span class="input-group-addon" rel="tooltip" data-original-title="Copie e compartilhe o link de suas ofertas!">
                <i class="fa fa-share-alt"></i>
              </span>
              <input type="text" class="form-control url-oferta" rel="tooltip" data-original-title="Copie e compartilhe o link de suas ofertas!" value="https://www.lancamentosonline.com.br/ofertas/{{ Auth::user()->construtora->id }}/{{ url_amigavel(Auth::user()->construtora->nome) }}-empreendimentos-em-oferta.html">
            </div>

            <div class="icone-copy"><button type="button" rel="tooltip" data-original-title="Copie e compartilhe o link de suas ofertas!" class="mb-xs mt-xs mr-xs btn btn-info copiarUrl"><i class="fa fa-copy"></i></button></div>
          </div>
        </div>
    </div>
</div>

<div style="clear:both; margin-bottom: 10px"></div>
<!-- start: page -->
<div class="row pricing-table">
  @if ($empreendimentos)
    @foreach ($empreendimentos as $empreendimento)
      @if ($empreendimento->ofertasAtivas->count() > 0)
        <div class="col-lg-4 col-sm-6">
          <div class="plan">
            <div class="plan-ribbon-wrapper">
              <div class="plan-ribbon">OFERTA</div>
            </div>
            <div class="foto-empreendimento">
              @if ($empreendimento->fotoPrincipal() !== null)
              <img src="{{ url($empreendimento->fotoPrincipal()) }}" class="img-responsive foto-produto" alt="{{ $empreendimento->nome }}">
              @else
              <img src="{{ url('assets/images/sem-foto.jpg') }}" style="width: 200px; height: 150px" class="img-responsive foto-produto" alt="{{ $empreendimento->nome }}">
              @endif
            </div>

            <h3>{{ $empreendimento->nome }}</h3>            

            <ul>                      
              @foreach ($empreendimento->ofertasAtivas as $oferta)
                <li>
                  @if ($empreendimento->tipo == 'Vertical')
                    <i class="fa fa-suitcase btn-oferta"></i> 
                    {{ $oferta->unidade->torre->nome }} <b>Unidade {{ $oferta->unidade->nome }}</b> Andar: {{ $oferta->unidade->andar->numero }}º  <br>
                    De {{ $oferta->preco_tabela }} Por {{ $oferta->preco_oferta }} Desconto: <span class="desconto">{{ $oferta->percentual_desconto }}%</span>
                  @else                                
                    <i class="fa fa-suitcase btn-oferta"></i> 
                    {{ $oferta->unidade->quadra->nome }} <b>Unidade {{ $oferta->unidade->nome }}</b> <br>
                    De <span style="color: black; text-decoration: line-through; font-weight: bold"> {{ $oferta->preco_tabela }}</span> Por <span style="color: green; font-weight: bold"> {{ $oferta->preco_oferta }} </span>Desconto: <span class="desconto">{{ $oferta->percentual_desconto }}%</span>
                  @endif

                  <br>

                  <button 
                  class="btn btn-primary" 
                  data-toggle="modal" 
                  data-target="#oferta"
                  data-url="{{ route('alterar-oferta', $oferta->id) }}"
                  data-titulo="{{ $empreendimento->nome }}"
                  data-method="GET"
                  style="height: 40px" 
                  data-oferta-id="{{ $oferta->id }}"
                  >
                    <i class="fa fa-pencil-square-o btn-editar"></i>
                  </button>        

                  <button 
                  style="height: 40px" 
                  class="btn btn-danger btn-remover" 
                  data-id="{{ $oferta->id }}" 
                  data-url="{{ route('excluir-oferta', $oferta->id) }}" 
                  >
                    <i class="fa fa-times-circle"></i>
                  </button>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
    @endforeach
  @else
    <h2>Nenhum empreendimento cadastrado</h2>
  @endif
</div>
<!-- end: page -->

<div class="modal fade" id="oferta" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog modal-lg" role="document">
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
<script src="/assets/javascripts/oferta/index.js"></script>
<script src="/assets/javascripts/oferta/form_oferta.js"></script>
<script src="/assets/javascripts/oferta/wizard.js"></script>
<script type="text/javascript">
  localStorage.clear();

  $(function(){
      // Executa o evento click no button
      $('.copiarUrl').click(function(){
          // Seleciona o conteúdo do input
          $('input.url-oferta').select();
          // Copia o conteudo selecionado
          var copiar = document.execCommand('copy');
          // Verifica se foi copia e retona mensagem
          if(copiar){
            Swal.fire(
              'Link Copiado!',
              'Compartilhe com seus clientes pelo whatsapp!',
              'success'
            )
          }else {
            Swal.fire(
              'Ops :(!',
              'tente novamente!',
              'error'
            )
          }
          // Cancela a execução do formulário
          return false;
      });
  });
</script>
@endsection