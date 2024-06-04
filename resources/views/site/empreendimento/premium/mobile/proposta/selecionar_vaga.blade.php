@extends('site/empreendimento/premium/layout_interno')

@push('meta')
<title>INICIO</title>
@endpush

@section('content')

    <div class="conteudo">

        @if($unidade->garagem->count() < 1 && $garagens->count() < 1)
        <script type="text/javascript">
            $(window).load(function() {
                Swal.fire({
                title: 'Não existe vaga definida para esta unidade.',
                text: 'Por favor, selecione sua vaga antes de continuar',
                imageUrl: '{{ asset("assets/premium/img/img-vaga.png") }}',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
                })
            });
        </script>
        @endif

        @if(isset($vagaExiste))
        <script type="text/javascript">
            $(window).load(function() {
                Swal.fire({
                    title: 'Esta vaga ja está adcionada na proposta!',
                    text: 'Por favor, selecione outra vaga ou clique em continuar',
                    imageUrl: '{{ asset("assets/premium/img/img-ops.png") }}',
                    imageWidth: 400,
                    imageHeight: 200,
                    imageAlt: 'Custom image'
                })
            });
        </script>
        @endif

        <div class="garagens">
            @if($unidade->garagem->count() > 0)
            <div class="titulo-vagas-proposta"><i class="fas fa-car" aria-hidden="true"></i> Vagas da Unidade</div>
            @foreach ($unidade->garagem as $garagem)
            <div class="garagem">
                <div class="icone">
                    @if($garagem->tipo_vaga == 'Gaveta Coberta' || $garagem->tipo_vaga == 'Gaveta Descoberta')
                    <i class="fas fa-car" aria-hidden="true"></i><i class="fas fa-car" aria-hidden="true"></i>
                    @else
                    <i class="fas fa-car" aria-hidden="true"></i>
                    @endif
                </div>
                <div class="nome">{{ $garagem->nome }}<br/><span class="pavimento">{{ $garagem->pavimento->nome ?? 'Nome do pavimento' }}</span></div>
                <div class="tipo">{{ $garagem->tipo_vaga }}<br/><span class="tipo-vaga">Tipo da Vaga</span></div>
            </div>
            @endforeach
            @endif


            @if($garagens->count() > 0)
            <div class="titulo-vagas-proposta extra"><i class="fas fa-car" aria-hidden="true"></i> Vagas Selecionadas</div>
            @foreach ($garagens as $garagem)
            <div class="garagem">
                <div class="icone">
                    @if($garagem->tipo_vaga == 'Gaveta Coberta' || $garagem->tipo_vaga == 'Gaveta Descoberta')
                    <i class="fas fa-car" aria-hidden="true"></i><i class="fas fa-car" aria-hidden="true"></i>
                    @else
                    <i class="fas fa-car" aria-hidden="true"></i>
                    @endif
                </div>
                <div class="nome">{{ $garagem->nome }}<br/><span class="pavimento">{{ $garagem->pavimento->nome ?? 'Nome do pavimento' }}</span></div>
                @if($garagem->formato_vaga == 'Extra')
                <div class="valor">{{ $garagem->formato_vaga }}<br/><span class="formato-vaga">{{  $garagem->caracteristicas->where('nome', 'valor_vaga')->first()->pivot->valor ?? 'R$ Consulte' }}</span></div>
                @else
                <div class="valor">{{ $garagem->formato_vaga }}<br/><span class="formato-vaga">-</div>
                @endif
                <div class="excluirVaga" data-id-vaga="{{ $garagem->id }}" data-nome-vaga="{{ $garagem->nome }}" ><i class="far fa-times-circle" aria-hidden="true"></i></div>
            </div>
            @endforeach
            @endif

        </div>
        <?php
        $mapaGaragem = $empreendimento->fotos->where('tipo', 'Mapa de Vagas')->where('status', 'Liberada')->first();
        ?>

        <div class="mapa">

            <a href="/uploads/empreendimento/{{ $mapaGaragem->empreendimento_id ?? '' }}/original/{{ $mapaGaragem->arquivo ?? '' }}" data-toggle="lightbox">
                <img src="{{ asset('assets/premium/img/btn-mapa-vagas.png') }}" class="img-responsive" alt="Botão Mapa de Vagas">
            </a>

        </div>

        @if($unidade->garagem->count() > 0 || $garagens->count() > 0)

        <div class="vaga-extra-select">
            <label for="nome">Deseja incluir vagas extras na proposta?</label>
            <form action="/proposta/gravar-vaga-extra" method="POST" name="FormGravarVagaExtra" id="FormGravarVagaExtra">
            @csrf
            <input type="hidden" name="id" value="{{ $proposta->id }}">
            <select class="form-control select" name="vaga_extra" id="vaga_extra">
                <option value="" selected>Selecione</option>
                <option value="Padrão" @if($proposta->vaga_extra == 'Padrão') selected @endif>SIM (Vaga Individual)</option>
                <option value="Gaveta Dupla" @if($proposta->vaga_extra == 'Gaveta Dupla') selected @endif>SIM (Vaga Gaveta Dupla)</option>
                <option value="Não" @if($proposta->vaga_extra == 'Não') selected @endif>NÃO</option>
            </select>
            </form>
        </div>

        <div class="vagas" id="boxVagasExtras" @if($proposta->vaga_extra <> 'Não') style="display: block;" @else style="display: none;"  @endif>

            <div class="titulo-vaga-extra">
                <div class="tit" id="ExtraPadrao"><i class="fas fa-car" aria-hidden="true"></i> Vaga Extra (Padrão): R$ {{ converte_valor_real($tabela->valor_vaga_extra) }}</div>
                <div class="tit" id="ExtraDupla"><i class="fas fa-car" aria-hidden="true"></i> Vaga Extra Dupla (Gaveta): R$ {{ converte_valor_real($tabela->valor_vaga_extra_gaveta) }}</div>
                O valor da vaga extra será acrescido à sua proposta
            </div>

            <!--
            @foreach ($vagas_extras as $vaga_extra)
                <div class="vaga extra" data-idvaga="{{ $vaga_extra->id }}" data-tipovaga="{{ $vaga_extra->formato_vaga }}" data-nomevaga="{{ $vaga_extra->nome }}">
                    <span class="icone-vaga">
                    @if($vaga_extra->tipo_vaga == 'Gaveta Coberta' || $vaga_extra->tipo_vaga == 'Gaveta Descoberta')
                        <i class="fas fa-car" aria-hidden="true"></i>
                        <i class="fas fa-car" aria-hidden="true"></i><br/>
                    @else
                        <i class="fas fa-car" aria-hidden="true"></i><br/>
                    @endif
                    </span>
                    <span class="nome-vaga">
                    {{ $vaga_extra->nome }}
                    </span>
                </div>
            @endforeach

            !-->

        </div>

        @else

        <div class="vagas">

            @foreach ($vagas as $vaga)
                <div class="vaga" data-idvaga="{{ $vaga->id }}" data-tipovaga="{{ $vaga->formato_vaga }}" data-nomevaga="{{ $vaga->nome }}">
                    <span class="icone-vaga">
                    @if($vaga->tipo_vaga == 'Gaveta Coberta' || $vaga->tipo_vaga == 'Gaveta Descoberta')
                        <i class="fas fa-car" aria-hidden="true"></i>
                        <i class="fas fa-car" aria-hidden="true"></i><br/>
                    @else
                        <i class="fas fa-car" aria-hidden="true"></i><br/>
                    @endif
                    </span>
                    <span class="nome-vaga">
                    {{ $vaga->nome }}
                    </span>
                </div>
            @endforeach

        </div>

        @endif

    </div>

    @include('site.empreendimento.premium.mobile.proposta.modal_unidade')
    @include('site.empreendimento.premium.mobile.proposta.modal_garagem')

    <!-- Modal -->
    <div class="modal fade" id="ModalVaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/proposta/gravar-vaga" method="POST" name="FormGravarVaga" id="FormGravarVaga">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
            <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="detalhe-vaga-modal">

                <input type="hidden" name="id" value="{{ $proposta->id }}">
                <div class="titulo-modal-vaga">Deseja incluir esta vaga na sua proposta?</div>
                <input type="hidden" name="idVaga">
                <input type="hidden" name="tipoVaga">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-primary">Sim</button>
            </div>
        </div>
        </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalRemoverVaga" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/proposta/remover-vaga" method="POST" name="FormRemoverVaga" id="FormRemoverVaga">
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle"></h5>
            <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body" id="detalhe-vaga-modal">
                <input type="hidden" name="proposta_id" value="{{ $proposta->id }}">
                <input type="hidden" name="vaga_id" value="">
                <div class="titulo-modal-vaga">Deseja REMOVER esta vaga na sua proposta?</div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-primary">Sim</button>
            </div>
        </div>
        </div>
        </form>
    </div>

@endsection

@push('rodape')
<div class="rodape">
    <a href="/proposta/{{ $proposta->id }}/editar-proposta"><div class="btn-voltar"><i class="fa fa-reply-all" aria-hidden="true"></i></div></a>
    @if($unidade->garagem->count() < 1 && $garagens->count() < 1)
    <div class="btn-gravar-dados marcarVaga"><i class="fa fa-send" aria-hidden="true"></i> Próxima etapa</div>
    @else
    <div class="btn-gravar-dados" onclick="ConferirProposta();"><i class="fa fa-send" aria-hidden="true"></i> Próxima etapa</div>
    @endif
</div>
@endpush
