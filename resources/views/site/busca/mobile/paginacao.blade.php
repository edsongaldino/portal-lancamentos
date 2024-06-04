@if (isset($paginacao))
{{ $paginacao->appends([
  'estado_id' => $parametros['estado_id'],
  'cidade_id' => $parametros['cidade_id'],
  'subtipo_id' => $parametros['subtipo_id'],
  'busca_rapida' => $parametros['busca_rapida'],
  'construtora_id_multiplo' => $parametros['construtora_id_multiplo'],
  'construtora_id' => $parametros['construtora_id'],
  'subtipo_id_multiplo' => $parametros['subtipo_id_multiplo'],
  'modalidade_id_multiplo' => $parametros['modalidade_id_multiplo'],
  'cidade_id_multiplo' => $parametros['cidade_id_multiplo'],
  'bairro_id_multiplo' => $parametros['bairro_id_multiplo'],
  'valor' => $parametros['valor'],
  'quarto' => $parametros['quarto'],
  'area' => $parametros['area'],
  ])->links() }}

@else

{{ $empreendimentos->links() }}

@endif