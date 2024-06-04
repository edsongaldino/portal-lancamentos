@extends('corretor.layouts.app')
@section('conteudo')
<div class="details-grid">
    <div class="details-shade">
        <div class="details-right">
            <img src="{{ asset('corretor/app-assets/images/logo.png') }}" alt=" " />
            <h3>Lançamentos Online</h3>
            <h4>Conectando o Corretor</h4>
        </div>
    </div>
</div>

<div class="parker" id="service">
    <div class="services">


        <div class="col-sm-6 goal-icons">
            <div class="goal">
                <div class=" hi-icon-effect-6">
                    <a href="{{ route('corretor.empreendimentos') }}" class="hi-icon fa fa-key"></a>
                    <h4>Empreendimentos</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 goal-icons">
            <div class="goal">
                <div class=" hi-icon-effect-6">
                    <a href="{{ route('corretor.propostas') }}" class="hi-icon glyphicon glyphicon-briefcase"></a>
                    <h4>Propostas</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 goal-icons">
            <div class="goal">
                <div class=" hi-icon-effect-6">
                    <a href="{{ route('corretor.leads') }}" class="hi-icon glyphicon glyphicon-envelope"></a>
                    <h4>Leads</h4>
                </div>
            </div>
        </div>

        <div class="col-sm-6 goal-icons">
            <div class="goal">
                <div class=" hi-icon-effect-6">
                    <a href="{{ route('corretor.perfil') }}" class="hi-icon glyphicon glyphicon-user"></a>
                    <h4>Meu Perfil</h4>
                </div>
            </div>
        </div>



        <div class="clearfix"></div>
    </div>

</div>

@include('corretor.layouts.includes.menu-rodape')
@endsection
