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
                    <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                        <div class="row">
                            <input placeholder="Nome" class="form-control" type="text" name="nome_contato[]" value="{{ $item['nome']}}">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                        <div class="row">
                            <input placeholder="E-mail" class="form-control" type="text" name="email_contato[]" value="{{ $item['email'] }}">
                        </div>
                    </div>
                    <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                        <div class="row">
                            <input placeholder="Telefone" type="text" name="telefone_contato[]" class="form-control fixo-contato input-telefone-contato" value="{{ $item['telefone'] }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-sm btn-default remover-contato"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
                <div style="clear: both;"></div>
            @endforeach
        @else
            <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                <div class="row">
                    <input placeholder="Nome" class="form-control" type="text" name="nome_contato[]">
                </div>
            </div>
            <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                <div class="row">
                    <input placeholder="E-mail" class="form-control" type="text" name="email_contato[]">
                </div>
            </div>
            <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
                <div class="row">
                    <input placeholder="Telefone" type="text" name="telefone_contato[]" class="form-control fixo-contato input-telefone-contato">
                </div>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-default remover-contato"><i class="fa fa-trash"></i></button>
            </div>
            <div style="clear: both;"></div>
        @endif        
    </div>    

    <div id="bloco-contato" style="display: none">        
        <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
            <div class="row">
                <input  placeholder="Nome" class="form-control" type="text" name="nome_contato[]">
            </div>
        </div>
        <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
            <div class="row">
                <input placeholder="E-mail" class="form-control" type="text" name="email_contato[]">
            </div>
        </div>
        <div class="col-md-3" style="margin-right: 20px; margin-bottom: 20px">
            <div class="row">
                <input placeholder="Telefone" type="text" name="telefone_contato[]" class="form-control fixo-contato input-telefone-contato">
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-sm btn-default remover-contato"><i class="fa fa-trash"></i></button>
        </div>
    </div>

    <div id="contatos"></div>

    <div style="margin-bottom: 10px; clear: both"></div>

    <button type="button" class="adicionar-contato btn btn-sm btn-default"> <i class="fa fa-plus"></i> Adicionar contato</button>

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

                $(document).on('mascara-telefone-contato', {}, function () {
                    $('.fixo-contato').mask('(00) 0000-0000');
                });
                 
                 $('.adicionar-contato').on('click', function() {
                    
                    var html = $("#bloco-contato").clone();

                    html.find('.input-telefone-contato').val('');

                    html.show();

                    // html.append('<div class="col-md-2"><button type="button" class="btn btn-sm btn-default remover-contato"><i class="fa fa-trash"></i></button></div><div style="clear: both;"></div>');
                    $('#contatos').append(html);
                    $(document).trigger("mascara-telefone-contato");
                 })
                                  
                 $(document).on('click', '.remover-contato', function (e) {
                     e.preventDefault();
                     $(this).parent().parent('div').remove();
                 });                 
            });
        </script>
    @endpush

@endif
{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}