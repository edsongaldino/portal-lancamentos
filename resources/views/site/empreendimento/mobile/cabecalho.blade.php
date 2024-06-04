@php
  $icone_tipo = '';
  if ($empreendimento->subtipo_id) {
    switch($empreendimento->subtipo_id):
      case 1:
        $icone_tipo = '<i class="fa fa-building"></i>';
      break;
      case 2:
        $icone_tipo = '<i class="fa fa-briefcase"></i>';
      break;
      case 3:
        $icone_tipo = '<i class="fa fa-home"></i>';
      break;
      case 4:
        $icone_tipo = '<i class="fa fa-tree"></i>';
      break;
    endswitch;  
  }  
@endphp
<div class="entry-main01">  
  @php
    $classe = strtolower($empreendimento->getCaracteristica('tipo_condominio'));

    if ($empreendimento->subtipo_id) {
      
      if($empreendimento->subtipo_id == 1) {
        $classe = "apartamento";
      }
      
      if($empreendimento->subtipo_id == 2) {
        $classe = "sala";
      } 
    }    
  @endphp
  <div class="box-icone-tipo-dt-{{ $empreendimento->subtipo_id }}" title="{{ $empreendimento->subtipo->nome }}">
    {!! $icone_tipo !!}
  </div>
  <span class="box-status-perfil-{{ $empreendimento->modalidade }}">
    {{ $empreendimento->modalidade }}
  </span>
  <span class="box-status-perfil-{{ url_amigavel(remove_caracter_especial($empreendimento->modalidade)) }}">{{ $empreendimento->modalidade }}</span>
</div>