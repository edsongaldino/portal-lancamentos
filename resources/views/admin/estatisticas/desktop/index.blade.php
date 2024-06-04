@extends('backpack::layout')
<!-- Specific Page Vendor CSS -->
<link rel="stylesheet" href="/assets/vendor/morris/morris.css" />
@section('content')
@section('header')
<header class="page-header">
  <h2>Dashboard</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="/admin/dashboard">
          <i class="fa fa-home"></i>
        </a>
      </li>
      <li><span>Dashboard</span></li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@php
$construtora_id = Auth::user()->construtora_id;

$percentual_acesso_existe = percentual_acesso($construtora_id, "Desktop");
$percentual_renda_existe = percentual_renda($construtora_id,'Inicial');
$percentual_interesse_existe = round(percentual_interesse($construtora_id,"Inicial"));
$percentual_origem_acesso = percentual_origem_acesso($construtora_id, "Google");

$mes6 = date('m', strtotime('-6 months'));
$mes5 = date('m', strtotime('-5 months'));
$mes4 = date('m', strtotime('-4 months'));
$mes3 = date('m', strtotime('-3 months'));
$mes2 = date('m', strtotime('-2 months'));
$mes1 = date('m', strtotime('-1 months'));

$mes_atual = date('m');

$ano6 = date('Y', strtotime('-6 months'));
$ano5 = date('Y', strtotime('-5 months'));
$ano4 = date('Y', strtotime('-4 months'));
$ano3 = date('Y', strtotime('-3 months'));
$ano2 = date('Y', strtotime('-2 months'));
$ano1 = date('Y', strtotime('-1 months'));

$ano_atual = date('Y');

@endphp

  <!-- start: page -->
  <div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
      <div class="row">
        <div class="col-md-12 col-lg-4 col-xl-4">
          <section class="panel panel-featured-left panel-featured-primary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-primary">
                    <i class="fa fa-building icon-chart"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Empreendimentos</h4>
                    <div class="info">
                      <strong class="amount">{{ empreendimentos($construtora_id) }}</strong>
                      <span class="text-primary">({{ unidades('Todas', null, $construtora_id) }} unidades)</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4">
          <section class="panel panel-featured-left panel-featured-tertiary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-tertiary">
                    <i class="fa fa-briefcase icon-chart"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Unidades vendidas</h4>
                    <div class="info">
                      <strong class="amount">{{ unidades('Vendida', null, $construtora_id) }}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
        <div class="col-md-12 col-lg-4 col-xl-4">
          <section class="panel panel-featured-left panel-featured-quartenary">
            <div class="panel-body">
              <div class="widget-summary">
                <div class="widget-summary-col widget-summary-col-icon">
                  <div class="summary-icon bg-quartenary">
                    <i class="fa fa-shopping-cart icon-chart"></i>
                  </div>
                </div>
                <div class="widget-summary-col">
                  <div class="summary">
                    <h4 class="title">Unidades disponíveis</h4>
                    <div class="info">
                      <strong class="amount">{{ unidades('Disponível', null, $construtora_id) }}</strong>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <section class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
          </div>
  
          <h2 class="panel-title">Relatórios (Visualizações e Cliques )</h2>
          <p class="panel-subtitle">Quantidade mensal de visualizações e cliques dos últimos 6 meses</p>
        </header>
        <div class="panel-body">
  
          <!-- Morris: Bar -->
          <div class="chart chart-md" id="morrisBar"></div>
          <script type="text/javascript">
            var morrisBarData = [{
              y: '{{ mes_extenso_abreviado($mes5)."/".$ano5 }}',
              a: {{ total_views($construtora_id,$mes5,$ano5) }},
              b: {{ total_cliques($construtora_id,$mes5,$ano5) }}
            }, {
              y: '{{ mes_extenso_abreviado($mes4)."/".$ano4 }}',
              a: {{ total_views($construtora_id,$mes4,$ano4) }},
              b: {{ total_cliques($construtora_id,$mes4,$ano4) }}
            }, {
              y: '{{ mes_extenso_abreviado($mes3)."/".$ano3 }}',
              a: {{ total_views($construtora_id,$mes3,$ano3) }},
              b: {{ total_cliques($construtora_id,$mes3,$ano3) }}
            }, {
              y: '{{ mes_extenso_abreviado($mes2)."/".$ano2 }}',
              a: {{ total_views($construtora_id,$mes2,$ano2) }},
              b: {{ total_cliques($construtora_id,$mes2,$ano2) }}
            }, {
              y: '{{ mes_extenso_abreviado($mes1)."/".$ano1 }}',
              a: {{ total_views($construtora_id,$mes1,$ano1) }},
              b: {{ total_cliques($construtora_id,$mes1,$ano1) }}
            }, {
              y: 'Mês Atual',
              a: {{ total_views($construtora_id,$mes_atual,$ano_atual) }},
              b: {{ total_cliques($construtora_id,$mes_atual,$ano_atual) }}
            }];
  
            // See: assets/javascripts/ui-elements/examples.charts.js for more settings.
  
          </script>
  
        </div>
      </section>
    </div>
  </div>

  <div class="row">
    @if ($percentual_interesse_existe > 0)
      <div class="col-md-6">
        <section class="panel">
          <header class="panel-heading">          
            <h2 class="panel-title">Percentual de Interesse (O que mais gostou)</h2>
            <p class="panel-subtitle">Percentual calculado de acordo com as informações inseridas nos leads</p>
          </header>
          <div class="panel-body">

            <!-- Morris: Donut -->
            <div class="chart chart-md" id="morrisDonut"></div>
            <script type="text/javascript">

              var morrisDonutData = [{
                label: "Preço",
                value: {{ round(percentual_interesse($construtora_id,"Preço")) }}
              }, {
                label: "Localização",
                value: {{ round(percentual_interesse($construtora_id,"Localização")) }}
              }, {
                label: "Área de Lazer",
                value: {{ round(percentual_interesse($construtora_id,"Área de Lazer")) }}
              }, {
                label: "Previsão de Entrega",
                value: {{ round(percentual_interesse($construtora_id,"Previsão de Entrega")) }}
              }, {
                label: "Opções de Plantas",
                value: {{ round(percentual_interesse($construtora_id,"Planta do imóvel")) }},
                color: '#2baab1'
              }];            
            </script>

          </div>
        </section>
      </div>
    @endif
    @if ($percentual_renda_existe > 0)
      <div class="col-md-6">
        <section class="panel">
          <header class="panel-heading">            
            <h2 class="panel-title">Perfil de Renda</h2>
            <p class="panel-subtitle">Percentual calculado de acordo com as informações inseridas nos leads</p>
          </header>
          <div class="panel-body">

            <!-- Flot: Pie -->
            <div class="chart chart-md" id="flotPie"></div>
            <script type="text/javascript">

              var flotPieData = [{
                label: "Até 3mil",
                data: [
                  [1, {{ percentual_renda($construtora_id,"Até 3.000,00") }}]
                ],
                color: '#0088cc'
              }, {
                label: "De 3 à 5mil",
                data: [
                  [2, {{ percentual_renda($construtora_id,"de 3.000 à 5.000") }}]
                ],
                color: '#2baab1'
              }, {
                label: "De 5 à 7mil",
                data: [
                  [3, {{ percentual_renda($construtora_id,"de 5.000 à 7.000") }}]
                ],
                color: '#734ba9'
              }, {
                label: "De 7 à 10mil",
                data: [
                  [4, {{ percentual_renda($construtora_id,"de 7.000 à 10.000") }}]
                ],
                color: '#FFC926'
              }, {
                label: "De 10 à 15mil",
                data: [
                  [5, {{ percentual_renda($construtora_id,"de 10.000 à 15.000") }}]
                ],
                color: '#E36159'
              }, {
                label: "Acima de 15mil",
                data: [
                  [6, {{ percentual_renda($construtora_id,"Acima de 15.000") }}]
                ],
                color: '#336699'
              }];
            </script>

          </div>
        </section>
      </div>
    @endif
  </div>

  <div class="row">
    @if ($percentual_acesso_existe > 0)
      <div class="col-md-6">
            <section class="panel">
              <header class="panel-heading">            
                <h2 class="panel-title">Acesso por plataforma</h2>
                <p class="panel-subtitle">Percentual de acessso por plataforma</p>
              </header>
              <div class="panel-body">

                <!-- Flot: Pie -->
                <div class="chart chart-md" id="flotPie2"></div>
                <script type="text/javascript">

                  var flotPieData2 = [{
                    label: "Desktop",
                    data: [
                      [1, {{ percentual_acesso($construtora_id, "Desktop") }}]
                    ],
                    color: '#0088cc'
                  }, {
                    label: "iPhone",
                    data: [
                      [2, {{ percentual_acesso($construtora_id,"iPhone") }}]
                    ],
                    color: '#2baab1'
                  }, {
                    label: "Android",
                    data: [
                      [3, {{ percentual_acesso($construtora_id,"Android") }}]
                    ],
                    color: '#734ba9'
                  }, {
                    label: "Ipad",
                    data: [
                      [4, {{ percentual_acesso($construtora_id,"ipad") }}]
                    ],
                    color: '#FFC926'
                  }];
                </script>

              </div>
            </section>
      </div>
    @endif

    @if ($percentual_origem_acesso > 0)
      <div class="col-md-6">
            <section class="panel">
              <header class="panel-heading">            
                <h2 class="panel-title">Origem do Acesso</h2>
                <p class="panel-subtitle">Percentual de acessso por origem</p>
              </header>
              <div class="panel-body">

                <!-- Flot: Pie -->
                <div class="chart chart-md" id="flotPie3"></div>
                <script type="text/javascript">

                  var flotPieData3 = [{
                    label: "Lançamentos Online",
                    data: [
                      [1, {{ percentual_origem_acesso($construtora_id, "Lançamentos Online") }}]
                    ],
                    color: '#0088cc'
                  }, {
                    label: "Google",
                    data: [
                      [2, {{ percentual_origem_acesso($construtora_id,"Google") }}]
                    ],
                    color: '#EA4335'
                  }, {
                    label: "Bing",
                    data: [
                      [3, {{ percentual_origem_acesso($construtora_id,"Bing") }}]
                    ],
                    color: '#34A853'
                  }, {
                    label: "Facebook",
                    data: [
                      [4, {{ percentual_origem_acesso($construtora_id,"Facebook") }}]
                    ],
                    color: '#FFC926'
                  }];
                </script>

              </div>
            </section>
      </div>
    @endif

  </div>
<!-- end: page -->
@endsection