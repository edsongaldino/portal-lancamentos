@php
  if ($torre_selecionada) {
    $torre = App\Models\Torre::find($torre_selecionada);    
  }
@endphp

@foreach($torre->andares as $andar) 
  @php
    $unidades = $andar->unidades->where('situacao', '<>', 'Excluído')->where('situacao', '<>', 'Bloqueada');
  @endphp

  <div class="toggle" data-plugin-toggle data-toggle="collapse">
    <section class="toggle active">
      <label>
        <i class="fa fa-building"></i>{{ $andar->torre->nome }} - Andar {{ $andar->numero }}
        <div class="pull-right" style="padding-right: 20px">
          <i class="fa fa-building" style="font-size: 20px"></i>
          {{ $andar->unidades->where('situacao', '<>', 'Excluído')->where('situacao', '<>', 'Bloqueada')->count() }} unidades  
        </div>        
      </label>        
      <div class="toggle-content">
        <section class="panel">
          <div class="panel-body">                  
              @include('admin.empreendimentos.desktop.empreendimento.unidade.filtrar', ['unidades' => $unidades])
          </div>
        </section>
      </div>
    </section>
  </div>
@endforeach