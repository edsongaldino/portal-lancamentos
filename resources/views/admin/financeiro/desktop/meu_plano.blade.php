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
        <a href="{{ route('leads') }}">Minha conta</a>
      </li>
    </ol>
    
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')
<section class="panel">


<div class="row" @if (!mensalidade_atraso()) style="display: none" @endif>
    <div class="col-md-12">
        <div class="alert alert-danger fade in nomargin">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <h4>EVITE BLOQUEIO DOS SEUS ANÚNCIOS!</h4>
            <p>Existem mensalidades em atraso conosco, pedimos que providencie o pagamento para que não haja bloqueio nos seus anúncios! O pagamento pode ser feito por boleto ou cartão de crédito.</p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="tabs lista-vendas">
            <ul class="nav nav-tabs">
                <li>
                    <a href="#recent" data-toggle="tab"><i class="fa fa-usd"></i> Mensalidades</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="recent" class="tab-pane active">                    
                    <div class="panel-body">
                        @if (isAdmin())
                          <button class="btn btn-success" data-toggle="modal" data-target="#lancamento-financeiro">
                              <i class="fa fa-file-pdf-o"></i> Criar lançamento financeiro
                          </button>
                        @endif

                        <div style="margin-bottom: 20px"></div>

                        <table class="table table-bordered table-striped mb-none" id="datatable-default">
                            <thead>
                                <tr>
                                    <th>Nº Lançamento</th>
                                    <th>Criado em</th>
                                    <th>Pagador</th>
                                    <th>Valor</th>
                                    <th>Vencimento</th>
                                    <th>Situação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lancamentos as $lancamento)
                                <tr class="lista-boletos">
                                    <td>{{ $lancamento->id }}</td>
                                    <td>{{ data_br($lancamento->created_at) }}</td>
                                    <td>{{ $lancamento->construtora->nome_abreviado ?? $lancamento->construtora->nome }}</td>
                                    <td class="valor-venda">R$ {{ $lancamento->valor }}</td>
                                    <td>{{ $lancamento->vencimento }}</td>
                                    <td>
                                        @if ($lancamento->situacao == 'Pago')
                                            <button type="button" class="mb-xs mt-xs mr-xs btn btn-warning">
                                                <i class="fa fa-check"></i> Pago
                                            </button>
                                        @elseif ($lancamento->situacao == 'Cancelado')
                                            <button type="button" class="mb-xs mt-xs mr-xs btn btn-danger">
                                                <i class="fa fa-danger"></i> Cancelado
                                            </button>
                                        @else
                                            <button type="button" class="mb-xs mt-xs mr-xs btn btn-warning">
                                                <i class="fa fa-warning"></i> Aberto
                                            </button>
                                        @endif
                                    </td>
                                    <td class="info-venda">
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-default">
                                            <i class="fa fa-cloud-download" aria-hidden="true"></i> NFe
                                        </button>
                                        <button type="button" class="mb-xs mt-xs mr-xs btn btn-info">
                                            <i class="fa fa-cloud-download" aria-hidden="true"></i> Boleto
                                        </button>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> 
                                                Ações <span class="caret"></span> 
                                            </button>
                                            <ul class="dropdown-menu menu-acoes-boleto">
                                                <li>                 
                                                    @php
                                                      $marginLeft = 0;
                                                      if (isAdmin()) {
                                                        $marginLeft = 22;
                                                      }
                                                    @endphp
                                                    
                                                    @if (!mensalidade_atraso())
                                                    <button style="background-color: white;color: black;border: none;margin-left: {{ $marginLeft  }}px;" type="button" data-toggle="modal" data-target="#modal-pagamento" data-url="{{ $lancamento->url }}">
                                                      <i class="fa fa-barcode" aria-hidden="true"></i> Atualizar Boleto
                                                    </button>
                                                    @else
                                                    <button style="background-color: white;color: black;border: none;margin-left: {{ $marginLeft  }}px;" type="button" data-toggle="modal" data-target="#modal-pagamento" data-url="{{ $lancamento->url }}">
                                                    <i class="fa fa-barcode" aria-hidden="true"></i> Download Boleto
                                                    </button>
                                                    @endif

                                                    <button style="background-color: white;color: black;border: none;margin-left: {{ $marginLeft  }}px;" type="button" data-toggle="modal" data-target="#modal-pagamento" data-url="{{ $lancamento->url }}">
                                                      <i class="fa fa-credit-card-alt" aria-hidden="true"></i> Pagar com Cartão
                                                    </button>
                                                </li>                                                       
                                                
                                                @if ($lancamento->situacao != 'Cancelado' && isAdmin())
                                                  <li>
                                                      <a class="reenviar-lancamento-email" data-url="{{ route('reenviar-lancamento-email', $lancamento->id) }}"><i class="fa fa-envelope"></i> Reenviar por e-mail</a>
                                                  </li>
                                                  
                                                  <li>
                                                      <a class="cancelar-lancamento-financeiro" data-url="{{ route('cancelar-lancamento-financeiro', $lancamento->transacao_id) }}"><i class="fa fa-trash"></i> Cancelar Lançamento</a>
                                                  </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="7" center>
                                        {{ $lancamentos->links() }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<div class="modal fade" id="lancamento-financeiro" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Novo Lançamento Financeiro</h4>
      </div>
      <div class="modal-body">
        <form id="form-lancamento-financeiro">
          <div class="form-group">
            <label class="">Construtora</label>
            <select class="form-control construtoras" name="construtora_id">
              <option value="">Selecione a construtora</option>
              @foreach (get_construtoras() as $construtora)
              <option value="{{ $construtora->id }}">
                {{ $construtora->nome_abreviado ?? $construtora->nome }}
              </option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="">Valor (R$)</label>
            <input style="width: 120px" type="text" name="valor" class="form-control moeda">       
          </div>
          <div class="form-group">
            <label class="">Tipo de Cobrança</label>
            <select style="width: 240px" class="form-control" name="tipo_cobranca">
              <option>Selecione o tipo de cobrança</option>
              <option value="Avulsa">Avulsa</option>
              <option value="Recorrente">Recorrente</option>
            </select>
          </div>

          <div id="dados-recorrencia" style="display: none">
            <div class="form-group">              
              <label class="">Gerar cobrança quantos dias antes do vencimento</label>
              <input style="width: 80px" type="number" min="0" name="dias_antes_vencimento_gerar_cobranca" class="form-control">
            </div>

            <div class="form-group">
              <label class="radio-inline">
                <input value="Nunca" type="radio" name="tipo_fim_cobranca" checked>Nunca Termina
              </label>
              <label class="radio-inline">
                <input value="Especifico" type="radio" name="tipo_fim_cobranca">Após X recorrências
              </label>                          
            </div>
                        
            <div id="especificar-recorrencias" style="display: none">
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="">Quantas recorrências?</label>
                    <input style="width: 80px" type="number" min="0" name="qtd_recorrencia" class="form-control">
                  </div>
                </div>  
              </div>
              
            </div>
          </div>

          <div class="form-group">
            <label class="">Vencimento</label>
            <input style="width: 180px" type="date" name="vencimento" class="form-control">       
          </div>
          <div class="form-group">
            <label class="">Descrição do serviço</label> <br>
            <textarea cols="80" rows="5" name="observacoes"></textarea>
          </div>
          <div class="form-group">
            <label class="">Gerar NF? &nbsp;</label>
            <input type="radio" name="gerar_nf" value="Sim"> Sim
            <input type="radio" name="gerar_nf" value="Não" checked="true"> Não
          </div>
          <div class="form-group">
            <label class="">Enviar cobrança por e-mail? &nbsp;</label>
            <input type="radio" name="enviar_email" value="Sim" checked="true"> Sim
            <input type="radio" name="enviar_email" value="Não"> Não
          </div>          
          <div class="form-group">            
            <button type="button" id="criar-lancamento-financeiro" class="btn btn-success">
                Criar Lançamento Financeiro
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-pagamento" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content modal-lg">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Efetuar Pagamento</h4>
      </div>
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div>

<!-- Specific Page Vendor -->
<script src="/assets/javascripts/unidade/index.js"></script>
<script src="/assets/javascripts/financeiro/index.js"></script>
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
    <script src="/assets/vendor/select2/js/select2.js"></script>
@endpush