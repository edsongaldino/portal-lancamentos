@extends('corretor.layouts.app')
@section('conteudo')
<div class="conteudo empreendimentos">
    <h3 class="perfil"><i class="fa fa-info"></i> Empreendimentos</h3>

    <div class="busca">
        <div class="icone-filtro"><span class="glyphicon glyphicon-search" aria-hidden="true"></div>
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="busca-cidade">
            <select class="form-control BuscaAjax" name="cidade" id="BuscaCidade">
                <option value="0" selected>Cidade</option>
                @foreach (get_cidades() as $cidade)
                <option value="{{ $cidade->id }}" @if($cidade_id == $cidade->id) selected @endif>{{ $cidade->nome }} ({{ $cidade->estado->uf }})</option>
                @endforeach
            </select>
        </div>
        <div class="busca-tipo">
            <select class="form-control BuscaAjax" name="tipo" id="BuscaTipo">
                <option value="0">Tipo:</option>
                @foreach (get_subtipos() as $subtipo)
                <option value="{{ $subtipo->id }}" @if($subtipo_id == $subtipo->id) selected @endif>{{ $subtipo->nome }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @foreach ($empreendimentos as $empreendimento)

        @php
            $icone_tipo = '';
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
        @endphp


        <div class="lista-empreendimentos">
            <a href="/corretor/empreendimento/{{ $empreendimento->id }}">
            <div class="titulo">
                <?php echo $icone_tipo;?>
                {{ $empreendimento->nome }}
            </div>
            <div class="foto"><img src="{{ $empreendimento->fotoPrincipal() }}" class="img-responsive" alt=""></div>
            <div class="info">

                @if($empreendimento->subtipo_id == 1)
                <div class="quartos"><span class="fa fa-bed"></span><br/> {!! qtd_dormitorio($empreendimento, true) !!}</div>
                <div class="garagem"><span class="fa fa-car"></span><br/> {!! vagas_empreendimento($empreendimento) !!}</div>
                <div class="metragem"><span class="fa fa-object-group"></span><br/> {!! qtd_metragem($empreendimento) !!}m²</div>
                @elseif($empreendimento->subtipo_id == 2)
                <div class="quartos"><span class="fa fa-columns"></span><br/> {{ get_elevadores($empreendimento->id) }}</div>
                <div class="garagem"><span class="fa fa-car"></span><br/> {!! vagas_empreendimento($empreendimento) !!}</div>
                <div class="metragem"><span class="fa fa-object-group"></span><br/> {!! qtd_metragem($empreendimento) !!}m²</div>
                @elseif($empreendimento->subtipo_id == 3 || $empreendimento->subtipo_id == 4)

                    @if($empreendimento->variacao->nome == "Lote")
                    <div class="quartos"><span class="fa fa-columns"></span><br/> {{ $empreendimento->quadras->count() }}</div>
                    <div class="garagem"><span class="fa fa-th-large" aria-hidden="true"></span><br/> {{ $empreendimento->unidades->count() }}</div>
                    <div class="metragem"><span class="fa fa-object-group"></span><br/> {{ converte_valor_real_semdecimal($empreendimento->getCaracteristica('area_unidade_min')) }}m²</div>
                    @else
                    <div class="quartos"><span class="fa fa-bed"></span><br/> {!! qtd_dormitorio($empreendimento, true) !!}</div>
                    <div class="garagem"><span class="fa fa-car"></span><br/> {!! vagas_empreendimento($empreendimento) !!}</div>
                    <div class="metragem"><span class="fa fa-object-group"></span><br/> {!! qtd_metragem($empreendimento) !!}m²</div>
                    @endif

                @endif

                <div class="titulo-comissao">Comissão de Vendas</div>
                <div class="comissao-corretor">Corretor <span class="valor">{{ $empreendimento->caracteristicas->where('nome', 'percentual_corretor')->first()->pivot->valor ?? '' }}%</span></div>
                <div class="comissao-imobiliaria">Imobiliária <span class="valor">{{ $empreendimento->caracteristicas->where('nome', 'percentual_imobiliaria')->first()->pivot->valor ?? '' }}%</span></div>

            </div>
            </a>
            <div class="endereco"><span class="fa fa-map-marker"></span> {{ $empreendimento->endereco->bairro->nome }}, {{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->estado->uf }}</div>
            <div class="contato-construtora"><img src="{{ url($empreendimento->getLogo()) }}" class="img-responsive logo-busca" alt=""></div>
            <a href="tel:{{ $empreendimento->getCaracteristica('telefone_central') }}"><div class="ligar-construtora"><span class="fa fa-phone"></span></div></a>
            <a href="https://api.whatsapp.com/send?phone=55{{ limpa_campo($empreendimento->getCaracteristica('whatsapp_atendimento')) }}&text=Ol%C3%A1%2C%20vi%20o%20an%C3%BAncio%20do%20empreendimento%20({{ $empreendimento->nome }})%20no%20Portal%20Lan%C3%A7amentos%20Online%20e%20gostaria%20de%20obter%20maiores%20informa%C3%A7%C3%B5es" target="_blank"><div class="whatsapp-construtora"><span class="fa fa-whatsapp"></span></div></a>
        </div>

    @endforeach



</div>



@include('corretor.layouts.includes.menu-rodape')

@endsection
