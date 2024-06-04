<!DOCTYPE html>
<html>
<head>
  <title>Disponibilidade</title>
  <link rel="stylesheet" href="/assets/vendor/bootstrap/css/bootstrap.css" />
  <link rel="stylesheet" href="/assets/vendor/font-awesome/css/font-awesome.css" />
  <style type="text/css">
    body {
      margin: 20px auto;
      width: 297mm;
      height: 210mm;
      padding: 40px;
    }
    
    table.report-container {
        page-break-after:always;
    }
    thead.report-header {
        display:table-header-group;
    }
    tfoot.report-footer {
        display:table-footer-group;
    } 
    .pagebreak { 
      page-break-before: always; 
    }
    tr.topo{
      background-color: #333 !important;
      color: #FFF !important;
      font-size: 20px !important;

    }

    tr.item{
      border: 1px solid #333 !important;
      border-spacing: 5px !important;
      border-collapse: separate !important;
    }

    table {
      border-spacing: 4px !important;
      border-collapse: separate !important;
    }

  </style>
</head>
<body>
  <table class="report-container" width="100%">
     
     <thead class="report-header">
       <tr>
          <th class="report-header-cell">
             <div class="header-info">
              <table class="table report-container" width="100%">
                <thead class="report-header">
                  <tr>
                    <td width="250" valign="middle">
                      @if ($empreendimento->getLogo() !== null)
                        <img src="{{ url($empreendimento->getLogo()) }}" style="width: 200px; height: 150px">
                      @else
                        <img src="{{ url('assets/images/sem-foto.jpg') }}" style="width: 200px; height: 150px">
                      @endif
                    </td>
                    <td valign="middle">          
                      <h4>
                        {{ $empreendimento->nome }}  
                      </h4>
                      <h6>
                        {{ $empreendimento->getEnderecoEmpreendimento() }}  
                      </h6>          
                    </td>
                    <td valign="middle" align="right">
                      <img src="{{ $empreendimento->construtora->getLogoUrl('260x260') }}" style="width: 200px; height: 150px"/>
                    </td>
                  </tr>                    
                </thead>
              </table>
             </div>
           </th>
        </tr>
        <tr>
          <td colspan="3">
            <h3>
              Disponibilidade
              <span style="float: right;">
                Documento Gerado em {{ date('d/m/Y') }}  
              </span>          
            </h3>              
          </td>          
        </tr>    
      </thead>
      
      <tbody class="report-content">
        <tr>
           <td class="report-content-cell">
              <div class="main">
                @if ($empreendimento->subtipo)
                  @if ($empreendimento->subtipo->nome == 'Apartamento')
                    @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_apartamento')
                  @endif
                  @if ($empreendimento->subtipo->nome == 'Sala Comercial')
                    @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_sala_comercial')
                  @endif  
                  @if ($empreendimento->subtipo->nome == 'Condomínio Fechado')
                    @if ($empreendimento->variacao->nome == 'Lote')
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_lote_condominio')
                    @else
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_casa_condominio')
                    @endif
                  @endif 
                  @if ($empreendimento->subtipo->nome == 'Residencial')
                    @if ($empreendimento->variacao->nome == 'Lote')
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_lote_condominio')
                    @else
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_casa_condominio')
                    @endif
                  @endif 
                  @if ($empreendimento->subtipo->nome == 'Comercial')
                    @if ($empreendimento->variacao->nome == 'Lote')
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_lote_condominio')
                    @else
                      @include('admin.empreendimentos.desktop.empreendimento.unidade.imprimir_disponibilidade_casa_condominio')
                    @endif
                  @endif 
                @else    
                  <h1>Defina a variação e subtipo do empreendimento antes de gerar a disponibilidade</h1>
                @endif  
              </div>
            </td>
         </tr>
       </tbody>
      
  </table>

  <script type="text/javascript">
    window.print();
  </script>
</body>
</html>