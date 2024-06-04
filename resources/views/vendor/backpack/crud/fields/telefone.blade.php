<?php
    $items = old(square_brackets_to_dots($field['name'])) ?? $field['value'] ?? $field['default'] ?? '';  

    $dados = false;
    
    if ($items) {
        $dados = true;
        $items = $items->toArray();        
    }
?>
  <div @include('crud::inc.field_wrapper_attributes') >
    <div>
        <div class="col-md-12">
            <div class="row">
                <label>{{ $field['label'] }}</label>        
            </div>
        </div>    
        @if ($dados)
            @foreach ($items as $item)                
                <div>
                    <div class="col-md-3">
                        <div class="row">
                            <select
                            class="form-control tipo_telefone"
                            name="tipo_telefone[]">
                            @foreach ($field['options'] as $key => $value)
                                <option value="{{ $key }}"
                                    @if ($key == $item['tipo'])
                                         selected
                                    @endif
                                >{{ $item['tipo'] }}</option>
                            @endforeach
                            </select>        
                        </div>
                    </div>
                    <div id="numero-telefone" class="col-md-4 col-md-offset-1">
                        <div class="row">
                            <input type="text" name="numero_telefone[]" class="form-control input-telefone" value="{{ $item['numero'] }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-sm btn-default remover-telefone"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div style="clear: both;"></div>
            @endforeach
        @else
            <div class="col-md-3">
                <div class="row">
                    <select
                    class="form-control tipo_telefone"
                    name="tipo_telefone[]">
                        @if (count($field['options']))
                            <option>Selecione o tipo</option>
                            @foreach ($field['options'] as $key => $value)
                                <option value="{{ $key }}"
                                    @if (isset($field['value']) && $key==$field['value'])
                                         selected
                                    @endif
                                >{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>        
                </div>
            </div>
            <div id="numero-telefone" class="col-md-4 col-md-offset-1">
                <div class="row">
                    <input type="text" name="numero_telefone[]" class="form-control input-telefone">
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-default remover-telefone"><i class="fa fa-trash"></i></button>
            </div>
            <div style="clear: both;"></div>
        @endif        
    </div>    

    <div id="bloco-telefone" style="display: none">
        <div class="col-md-3">
            <div class="row">
                <select
                class="form-control tipo_telefone"
                name="tipo_telefone[]">
                    @if (count($field['options']))
                        <option>Selecione o tipo</option>
                        @foreach ($field['options'] as $key => $value)
                            <option value="{{ $key }}"
                                @if (isset($field['value']) && $key==$field['value'])
                                     selected
                                @endif
                            >{{ $value }}</option>
                        @endforeach
                    @endif
                </select>        
            </div>
        </div>
        <div id="numero-telefone" class="col-md-4 col-md-offset-1">
            <div class="row">
                <input type="text" name="numero_telefone[]" class="form-control input-telefone">
            </div>
        </div>
    </div>

    <div id="telefones"></div>

    <div style="margin-bottom: 10px; clear: both"></div>

    <button type="button" class="adicionar-telefone btn btn-sm btn-default"> <i class="fa fa-plus"></i> Adicionar telefone</button>

    @if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif
  </div>


{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}
@if ($crud->checkIfFieldIsFirstOfItsType($field, $fields))

    {{-- FIELD JS - will be loaded in the after_scripts section --}}
    @push('crud_fields_scripts')
        <!-- select_template crud field JS -->
        <script>
            $(function () {

                $(document).on('mascara-telefone', {}, function () {
                    $('.celular').mask('(00) 00000-0000');
                    $('.fixo').mask('(00) 0000-0000');
                });
                 
                 $('.adicionar-telefone').on('click', function() {
                    var html = $("#bloco-telefone").clone();

                    html.find('.input-telefone').val('');

                    html.show();

                    html.append('<div class="col-md-4"><button type="button" class="btn btn-sm btn-default remover-telefone"><i class="fa fa-trash"></i></button></div><div style="clear: both;"></div>');
                    $('#telefones').append(html);
                    $(document).trigger("mascara-telefone");
                 })
                                  
                 $(document).on('click', '.remover-telefone', function (e) {
                     e.preventDefault();
                     $(this).parent().parent('div').remove();
                 });
                 
                $(document).on('change', '.tipo_telefone', function () {
                    var tipo = $(this).val();

                    if (tipo == 'Celular' || tipo == 'WhatsApp') {
                        $(this).parent().parent().siblings('#numero-telefone').find('.row').find('.input-telefone').unmask().mask('(00) 00000-0000');
                    } else {
                        $(this).parent().parent().siblings('#numero-telefone').find('.row').find('.input-telefone').unmask().mask('(00) 0000-0000');
                    }
                });
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}