@extends('admin.empreendimentos.desktop.empreendimento.layout')
@section('conteudo_empreendimento')
    <div class="col-md-10 col-lg-9">
        @include('admin.empreendimentos.desktop.empreendimento.breadcrumb')
        <div class="row">
            <div class="col-xs-12">
                <section class="panel">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                            <a href="#" class="fa fa-times"></a>
                        </div>
        
                        <h2 class="panel-title">Informações da Planta</h2>
                    </header>
                    <div class="panel-body">
                        <form @if (isset($planta))id="atualizar-dados-planta" @else id="cadastrar-dados-planta" @endif  class="form-horizontal form-bordered planta">                            
                            <input type="hidden" name="id" value="@if (isset($planta)){{ $planta->id }}@endif">
                            <input type="hidden" name="empreendimento_id" value="{{ $entry->id }}">
                            <div class="form-group">

                                <label class="col-md-2 control-label">Nome</label>
                                <div class="col-md-2">
                                    <input type="text" name="nome" class="form-control" value="@if (isset($planta)){{ $planta->nome }}@endif">
                                </div>
                                
                                <label class="col-md-2 control-label">Área privativa metragem (m<sup>2</sup>)</label>
                                <div class="col-md-2">
                                    <input class="form-control moeda2" type="text" name="area_privativa" value="@if(isset($planta)){{  $planta->area_privativa }}@endif">
                                </div>
                                
                                <label class="col-md-2 control-label">Tipo da Planta</label>
                                <div class="col-md-2">
                                    <select name="planta_tipo" class="form-control tipo-planta">   
                                        
                                        @if($entry->tipo == 'Vertical')
                                        <option value="Apartamento" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Apartamento') selected="true" @endif
                                            @endif>Apartamento</option>
                                        <option value="Sala Comercial" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                            @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Sala Comercial') selected="true" @endif
                                            @endif>Sala Comercial</option> 
                                        <option value="Linear" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Linear') selected="true" @endif
                                            @endif>Cobertura Linear</option>   
                                            
                                        <option value="Duplex" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Duplex') selected="true" @endif
                                            @endif>Cobertura Duplex</option>  

                                        <option value="Triplex" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Triplex') selected="true" @endif
                                            @endif>Cobertura Triplex</option>

                                        @elseif($entry->tipo == 'Horizontal')
                                        <option value="Casa Térrea" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Casa Térrea') selected="true" @endif
                                            @endif>Casa Térrea</option>

                                        <option value="Sobrado" 
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'planta_tipo')->first())
                                                    @if ($planta->caracteristicas->where('nome', 'planta_tipo')->first()->pivot->valor == 'Sobrado') selected="true" @endif
                                            @endif>Sobrado</option>                                
                                        @endif
                                    </select>
                                </div>
                            </div>
                            
                            @if ($entry->subtipo)
                                @if ($entry->subtipo->id == 2 || $entry->subtipo->id == 5)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Qtde Banheiros</label>
                                        <div class="col-md-2">                                
                                            @if(isset($planta) && $planta->caracteristicas->where('nome', 'qtd_banheiro')->first())
                                                <input class="form-control" type="text" name="qtd_banheiro" value="{{  $planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor }}">
                                            @else
                                                <input class="form-control" type="text" name="qtd_banheiro">
                                            @endif                                                                  
                                        </div>

                                        <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-coffee" aria-hidden="true"></i>
                                            </span>
                                            <select name="possui_copa" class="form-control">
                                                <option value="" disabled>Possui copa?</option>
                                                <option value="Não" 
                                                    @if (isset($planta) && $planta->caracteristicas->where('nome', 'possui_copa')->first())
                                                            @if ($planta->caracteristicas->where('nome', 'possui_copa')->first()->pivot->valor == 'Não') selected="true" 
                                                            @endif
                                                    @endif>Não
                                                </option>    

                                                <option value="Sim" 
                                                    @if (isset($planta) && $planta->caracteristicas->where('nome', 'possui_copa')->first())
                                                            @if ($planta->caracteristicas->where('nome', 'possui_copa')->first()->pivot->valor == 'Sim') selected="true" 
                                                            @endif
                                                    @endif>Sim
                                                </option>     
                                            </select>
                                        </div>
                                        </div>

                                        <div class="col-md-2">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-object-ungroup" aria-hidden="true"></i>
                                            </span>
                                            <select name="possui_laje_tecnica" id="possui_laje_tecnica" class="form-control">
                                                <option value="" disabled>Possui laje técnica?</option>

                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'laje_tecnica')->first())
                                                    <option value="Sim" selected="true">Sim</option>
                                                    <option value="Não">Não</option>    
                                                @else  
                                                    <option value="Sim">Sim</option>
                                                    <option value="Não" selected="true">Não</option>    
                                                @endif

                                            </select>
                                        </div>
                                        </div>

                                        @if (isset($planta) && $planta->caracteristicas->where('nome', 'laje_tecnica')->first())
                                        <div class="col-md-4" id="laje_tecnica" style="display: block;">
                                        @else
                                        <div class="col-md-4" id="laje_tecnica" style="display: none;">
                                        @endif
                                            <label class="col-md-6 control-label">Laje Técnica (m²)</label>
                                            <div class="col-md-6">  
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-object-ungroup" aria-hidden="true"></i>
                                                </span>                              
                                                @if(isset($planta) && $planta->caracteristicas->where('nome', 'laje_tecnica')->first())
                                                    <input class="form-control moeda2" type="text" name="laje_tecnica" value="{{  $planta->caracteristicas->where('nome', 'laje_tecnica')->first()->pivot->valor }}">
                                                @else
                                                    <input class="form-control moeda2" type="text" name="laje_tecnica">
                                                @endif                                                                  
                                            </div>
                                            </div>
                                        </div>



                                        <div style="clear: both; margin-bottom: 10px; padding-bottom: 10px"></div>                                                
                                    </div>
                                @else
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Dormitórios</label>
                                        <div class="col-md-2">                                
                                            @if(isset($planta) && $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first())
                                                <input class="form-control" type="text" name="qtd_dormitorio" value="{{  $planta->caracteristicas->where('nome', 'qtd_dormitorio')->first()->pivot->valor }}">
                                            @else
                                                <input class="form-control" type="text" name="qtd_dormitorio">
                                            @endif                                                                  
                                        </div>

                                        <label class="col-md-1 control-label">Sendo suítes</label>
                                        <div class="col-md-2">
                                            @if (isset($planta) && $planta->caracteristicas->where('nome', 'qtd_suite')->first())
                                                <input class="form-control" type="text" name="qtd_suite" value="{{  $planta->caracteristicas->where('nome', 'qtd_suite')->first()->pivot->valor }}">
                                            @else
                                                <input class="form-control" type="text" name="qtd_suite">
                                            @endif
                                        </div>

                                        <label class="col-md-2 control-label">Qtde Banheiros</label>
                                        <div class="col-md-2">                                
                                            @if(isset($planta) && $planta->caracteristicas->where('nome', 'qtd_banheiro')->first())
                                                <input class="form-control" type="text" name="qtd_banheiro" value="{{  $planta->caracteristicas->where('nome', 'qtd_banheiro')->first()->pivot->valor }}">
                                            @else
                                                <input class="form-control" type="text" name="qtd_banheiro">
                                            @endif                                                                  
                                        </div>

                                        <div style="clear: both; margin-bottom: 10px; padding-bottom: 10px"></div>                                                
                                    </div>
                                @endif                            
                            @endif                        
                                
                            @if($entry->tipo == 'Horizontal')
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Vagas de garagem</label>
                                    <div class="col-md-2">                                
                                        @if(isset($planta) && $planta->caracteristicas->where('nome', 'vagas_garagem')->first())
                                            <input class="form-control" type="text" name="vagas_garagem" value="{{  $planta->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor }}">
                                        @else
                                            <input class="form-control" type="text" name="vagas_garagem">
                                        @endif                                                                  
                                    </div>
                                
                                    <label class="col-md-1 control-label">Tipo Vaga</label>
                                    <div class="col-md-2">
                                        <select name="tipo_garagem" class="form-control">    
                                            <option value="Coberta" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'tipo_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'tipo_garagem')->first()->pivot->valor == 'Coberta') selected="true" @endif
                                                @endif>Coberta</option>

                                            <option value="Descoberta" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'tipo_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'tipo_garagem')->first()->pivot->valor == 'Descoberta') selected="true" @endif
                                                @endif>Descoberta</option>

                                            <option value="CobertaDescoberta" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'tipo_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'tipo_garagem')->first()->pivot->valor == 'CobertaDescoberta') selected="true" @endif
                                                @endif>Coberta e Descoberta</option>
                                        </select>
                                    </div>

                                    <label class="col-md-1 control-label">Formato Vaga</label>
                                    <div class="col-md-2">
                                        <select name="formato_garagem" class="form-control">    
                                            <option value="Livre" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'formato_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'formato_garagem')->first()->pivot->valor == 'Livre') selected="true" @endif
                                                @endif>Livre</option>

                                            <option value="Gaveta" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'formato_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'formato_garagem')->first()->pivot->valor == 'Gaveta') selected="true" @endif
                                                @endif>Gaveta</option>

                                            <option value="LivreGaveta" 
                                                @if (isset($planta) && $planta->caracteristicas->where('nome', 'formato_garagem')->first())
                                                        @if ($planta->caracteristicas->where('nome', 'formato_garagem')->first()->pivot->valor == 'LivreGaveta') selected="true" @endif
                                                @endif>Livre e Gaveta</option>
                                        </select>
                                    </div>

                                    <div style="clear: both; margin-bottom: 10px; padding-bottom: 10px"></div>                                                
                                </div>
                            @endif

                            <div class="form-group">
                                <label class="col-md-2 control-label">Outros Ambientes</label>
                                <div class="col-md-10">
                                    <select name="caracteristicas[]" multiple data-plugin-selectTwo class="form-control populate">
                                        <optgroup label="Itens da planta">
                                            @foreach ($caracteristicas as $item)
                                                <option value="{{ $item['id'] }}" @if (isset($item['selected']) && $item['selected'] == 'true') selected="true" @endif>
                                                    {{ $item['nome'] }}
                                                </option>  
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <br>
                            
                            
                            <div id="foto-planta" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group upload-imagem">
                                        <label class="col-md-2 control-label">Foto da Planta</label>
                                        <div class="col-md-10">
                                            <input name="foto_planta" type="file" class="file">
                                        </div>                                        
                                    </div>    
                                </div>
                                <div class="col-md-6">
                                    @if (isset($planta) && $planta->getUrlById($planta->foto_planta) && !$planta->getUrlById($planta->foto_primeira_planta))
                                        <a href="{{ $planta->getUrlById($planta->foto_planta) }}" data-lightbox="plantas" data-title="Planta">
                                            <img src="{{ $planta->getUrlById($planta->foto_planta) }}" width="300">
                                        </a>
                                        <hr>
                                    @endif
                                </div>
                            </div>
                            
                            <div id="foto-planta-1" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group upload-imagem">
                                        <label class="col-md-2 control-label">Foto da 1º Planta</label>
                                        <div class="col-md-10">
                                            <input name="foto_primeira_planta" type="file" class="file">
                                        </div>
                                    </div>    
                                </div>
                                
                                <div class="col-md-6">
                                    @if (isset($planta) && $planta->getUrlById($planta->foto_primeira_planta))
                                        <a href="{{ $planta->getUrlById($planta->foto_primeira_planta) }}" data-lightbox="plantas" data-title="Primeira Planta">
                                            <img src="{{ $planta->getUrlById($planta->foto_primeira_planta) }}" width="300">
                                        </a>
                                        <hr>
                                    @endif    
                                </div>
                            </div>
                            
                            <div id="foto-planta-2" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group upload-imagem">
                                        <label class="col-md-2 control-label">Foto da 2º Planta</label>
                                        <div class="col-md-10">
                                            <input name="foto_segunda_planta" type="file" class="file">
                                        </div>
                                    </div>    
                                </div>
                                
                                <div class="col-md-6">
                                    @if (isset($planta) && $planta->getUrlById($planta->foto_segunda_planta))
                                        <a href="{{ $planta->getUrlById($planta->foto_segunda_planta) }}" data-lightbox="plantas" data-title="Segunda Planta">
                                            <img src="{{ $planta->getUrlById($planta->foto_segunda_planta) }}" width="300">
                                        </a>
                                        <hr>
                                    @endif
                                </div>                            
                            </div>
                            
                            <div id="foto-planta-3" style="display: none">
                                <div class="col-md-6">
                                    <div class="form-group upload-imagem">
                                        <label class="col-md-2 control-label">Foto da 3º Planta</label>
                                        <div class="col-md-10">
                                            <input name="foto_terceira_planta" type="file" class="file">
                                        </div>
                                    </div>    
                                </div>
                                
                                <div class="col-md-6">
                                    @if (isset($planta) && $planta->getUrlById($planta->foto_terceira_planta))
                                        <a href="{{ $planta->getUrlById($planta->foto_terceira_planta) }}" data-lightbox="plantas" data-title="Terceira Planta">
                                            <img src="{{ $planta->getUrlById($planta->foto_terceira_planta) }}" width="300">
                                        </a>                                                
                                    @endif    
                                </div>
                            </div>                            
                        </form>
                    </div>
                </section>
            </div>
        </div>

        <button data-id="{{ $entry->id }}" @if (isset($planta))id="atualizar-planta" @else id="cadastrar-planta" @endif type="button" class="mb-xs mt-xs mr-xs btn btn-success salvar-planta"><i class="fa fa-save"></i> Salvar Informações da Planta</button>
    </div>

<script src="/assets/javascripts/planta/index.js"></script>

@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/select2.css" />
@endpush

@push('after_scripts')

<!-- Specific Page Vendor -->
<script src="/assets/vendor/gauge/gauge.js"></script>

<!-- Specific Page Vendor -->
<script src="/assets/vendor/select2/select2.js"></script>

<!-- Theme Initialization Files -->
<script src="/assets/javascripts/theme.init.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/ui-elements/examples.charts.js"></script>

<!-- Examples -->
<script src="/assets/javascripts/forms/examples.advanced.form.js" /></script>

@endpush