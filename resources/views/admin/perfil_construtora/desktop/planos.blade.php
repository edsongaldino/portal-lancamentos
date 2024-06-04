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
<h4>Ao alterar o plano, o mesmo inicia no mês seguinte</h4>
<div class="row">
  <div class="col-xs-12">
    <section class="panel form-wizard" id="w10">
      <header class="panel-heading">
        <div class="panel-actions">
          <a href="#" class="panel-action panel-action-toggle" data-panel-toggle=""></a>
          <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss=""></a>
        </div>

        <h2 class="panel-title">Alterar plano</h2>
      </header>
      <div class="panel-body">
        <div class="wizard-progress wizard-progress-lg">
          <div class="steps-progress">
            <div class="progress-indicator" style="width: 0%;"></div>
          </div>
          <ul class="wizard-steps">
            <li class="active">
              <a href="#w10-plano" data-toggle="tab"><span>1</span>Plano</a>
            </li>
            <li>
              <a href="#w10-pagamento" data-toggle="tab"><span>2</span>Pagamento</a>
            </li>
          </ul>
        </div>

        <form id="alterar-plano" class="form-horizontal" novalidate="novalidate">
          <input type="hidden" name="" id="ct_id" value="{{ $construtora_id }}">
          <input type="hidden" name="bandeira" value="" id="bandeira-input">
          <input type="hidden" name="token" value="" id="token">
          <div class="tab-content">
            <div id="w10-plano" class="tab-pane active">
              <div class="row">  
                <div class="pricing-table">    
                  @foreach ($assinaturas as $assinatura)
                  <div class="col-lg-3 col-sm-6">
                    <div class="plan">
                      <h3>{{ $assinatura->nome }}<span>R$ {{ $assinatura->preco }}</span></h3>                    
                      <ul>
                        <li><b>{{ $assinatura->quantidade_produtos }}</b> Produtos</li>
                        <li><b>Ilimitadas</b> Unidades</li>
                      </ul>
                      <br>
                      <input type="radio" name="plano" value="{{ $assinatura->nome }}">
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div id="w10-pagamento" class="tab-pane">
              <div class="form-group">
                <label class="col-sm-3 control-label" id="bandeira-cartao" for="w10-cc">Cartão de crédito</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control cartao-credito" name="numero" id="numero-cartao" required="" aria-required="true" data-iugu="number">
                  <small id="validacao-cartao" style="color: red"></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="w10-cc">Nome do titular</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="nome" id="titular" required="" aria-required="true" placeholder="Nome do titular, Como aparece no cartão" data-iugu="full_name">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="w10-cc">Mês/Ano</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control mes_ano" id="mes_ano" name="mes_ano" required="" aria-required="true" placeholder="MM/AA" data-iugu="expiration">
                  <small id="validacao-mes-ano" style="color: red"></small>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" id="bandeira-cartao" for="w10-cc">Código de segurança (CVV)</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control cvv" name="numero" id="cvv" required="" aria-required="true" data-iugu="verification_value">
                  <small id="validacao-cvv" style="color: red"></small>
                </div>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-success" id="efetuar-pagamento" value="Efetuar pagamento">
                </div>
              </div>
          </div>
        </form>
      </div>
      <div class="panel-footer">
        <ul class="pager">
          <li class="previous disabled">
            <a><i class="fa fa-angle-left"></i> Anterior</a>
          </li>
          <li class="finish hidden pull-right">
            <a>Finalizar</a>
          </li>
          <li class="next">
            <a>Próximo <i class="fa fa-angle-right"></i></a>
          </li>
        </ul>
      </div>
    </section>
  </div>  
</div>
@endsection

@push('after_scripts')
<script src="/assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="/assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
<script src="/assets/vendor/pnotify/pnotify.custom.js"></script>
<script src="/assets/javascripts/forms/examples.wizard.js"></script>
<script src="/assets/javascripts/perfil/plano.js"></script>
@endpush