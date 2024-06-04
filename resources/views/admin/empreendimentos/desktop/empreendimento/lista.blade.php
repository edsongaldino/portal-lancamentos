<!-- start: page -->
<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
  <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
    @if (count($empreendimentos))
      @foreach ($empreendimentos as $empreendimento) 
        <div class="col-sm-6 col-md-4 col-lg-3">
          <div class="panel-body box-empreendimento">
            
            <div class="thumb-info mb-md">
              @if ($empreendimento->status == 'Bloqueada')
              <div class="bloqueado"></div>
              @elseif(unidades('Disponível', $empreendimento->id) == 0)
              <div class="cpcvendido"></div>
              @endif



              @if ($empreendimento->fotoPrincipal() !== null)
                <img src="{{ url($empreendimento->fotoPrincipal()) }}" alt="{{ $empreendimento->nome }}" class="rounded img-responsive foto-destaque">
              @else
                <img src="{{ url('assets/images/sem-foto.jpg') }}" alt="{{ $empreendimento->nome }}" class="rounded img-responsive foto-destaque">
              @endif
              <div class="thumb-info-title">
                <span class="thumb-info-inner titulo-empreendimento">{{ $empreendimento->nome }}</span>
                <span class="thumb-info-type">{{ $empreendimento->modalidade }}</span>
              </div>
            </div>

            <hr class="dotted short">

            <div class="icone-acao">

              @if (Auth::user()->getRoleNames() == '["Diretor"]' || Auth::user()->getRoleNames() == '["Marketing"]' || Auth::user()->getRoleNames() == '["Gerente de Vendas"]' || isAdmin())
              <a rel="tooltip" class="edit" data-placement="bottom" href="{{ route('empreendimento.editar', ['id' => $empreendimento->id]) }}" data-original-title="Editar">
                <i class="fa fa-edit"></i>
                <span>Editar Empreendimento</span>
              </a>
              <a rel="tooltip" data-id="{{ $empreendimento->id }}" class="remove remover-empreendimento" data-placement="bottom" href="#" data-original-title="Remover">
                <i class="fa fa-close"></i>
                <span>Excluir Empreendimento</span>
              </a>
              @endif

              @if (Auth::user()->getRoleNames() == '["Corretor"]')
              <a rel="tooltip" class="edit" data-placement="bottom" href="{{ route('empreendimento.visualizar', ['id' => $empreendimento->id]) }}" data-original-title="Visualizar">
                <i class="fa fa-eye"></i>
                <span>Visualizar Empreendimento</span>
              </a>

              <a rel="tooltip" class="view" data-placement="bottom" href="{{ route('unidades', ['id' => $empreendimento->id]) }}" data-original-title="Visualizar Unidades">
                <i class="fa fa-columns"></i>
                <span>Visualizar Unidades</span>
              </a>

              <a rel="tooltip" class="car" data-placement="bottom" href="{{ route('garagens', ['id' => $empreendimento->id]) }}" data-original-title="Visualizar Vagas de Garagem">
                <i class="fa fa-car"></i>
                <span>Visualizar vagas</span>
              </a>

              @endif

              @if ($empreendimento->tipo == 'Horizontal' && $empreendimento->getFotoTipo('Implantação') && $empreendimento->unidades->count() > 0)
                <a target="_blank" rel="tooltip" data-original-title="Mapa"  data-placement="bottom" href="/empreendimento/{{ $empreendimento->id }}/{{ Auth::user()->id*37 }}/visualizar-mapa/view">
                  <i class="fa fa-image"></i>
                  <span>Mapa</span>
                </a>
              @endif
            </div>
          </div> 
        </div>
      @endforeach
    @endif
  </div>
</section>