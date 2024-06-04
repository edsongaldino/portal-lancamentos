<!-- Select template field. Used in Backpack/PageManager to redirect to a form with different fields if the template changes. A fork of the select_from_array field with an extra ID and an extra javascript file. -->
  <div @include('crud::inc.field_wrapper_attributes') >
    
    @forelse ($field['model']->construtora as $endereco)
        @php
            $end = $endereco
        @endphp
    @empty
        @php
            $end = null
        @endphp
    @endforelse
    
    <div class="row">
        <div class="col-md-12 form-group">
            <label>Logradouro</label>
            <input 
                type="text" name="logradouro" 
                value="@if (isset($end)) {{ $end->logradouro }}@endif "
                class="form-control"
            ">
        </div>

        <div class="col-md-8 form-group">        
            <label>Complemento</label>
            <input 
                type="text" 
                name="complemento" 
                value="@if (isset($end)) {{ $end->complemento }}@endif "
                class="form-control"
            ">
        </div>

        <div class="col-md-4 form-group">
            <label>Número</label>
            <input 
                type="text" 
                name="numero" 
                value="@if (isset($end)) {{ $end->numero }}@endif"
                class="form-control"
            ">
        </div>
    </div>

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

                 //Once add button is clicked
                 $('.adicionar-telefone').on('click', function() {
                    var html = $("#bloco-telefone").clone();

                    html.find('.input-telefone').val('');

                    html.append('<div style="clear:both;"></div><div style="margin-top: 10px"><button type="button" class="btn btn-sm btn-default remover-telefone"><i class="fa fa-trash"></i></button></div>');
                    $('#telefones').append(html);
                    $(document).trigger("mascara-telefone");
                 })
                 
                 //Once remove button is clicked
                 $('#telefones').on('click', '.remover-telefone', function(e){
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