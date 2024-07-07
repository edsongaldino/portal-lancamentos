@extends('backpack::layout_guest')

<!-- Main Content -->
@section('content')
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/admin/login" class="logo pull-left">
                <img src="/assets/images/logo.png" height="54" alt="Lançamentos Online" />
            </a>

            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> {{ trans('backpack::base.reset_password') }}</h2>
                </div>
                <div class="panel-body">
                    @if (isset($status))
                        @if ($status == "Erro")
                            <div class="alert alert-warning">
                                {{ $mensagem }}
                            </div>
                        @elseif ($status == "Sucesso")
                        <div class="alert alert-success">
                            {{ $mensagem }}
                        </div>
                        @endif
                    @else
                        <div class="alert alert-info">
                            <p class="m-none text-weight-semibold h6">Digite seu e-mail abaixo e nós lhe enviaremos as instruções!</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('backpack.auth.password.email') }}">
                        {{ csrf_field() }}                    

                        <div class="form-group mb-none">
                            <div class="input-group">
                                <input name="email" type="email" placeholder="E-mail" class="form-control input-lg" />
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-lg" type="submit">{{ trans('backpack::base.send_reset_link') }}</button>
                                </span>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <p class="text-center mt-lg">Lembrou? <a href="{{ route('backpack.auth.login') }}">Acessar!</a></p>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }} Lançamentos Online. Todos os direitos reservados.</p>
        </div>
    </section>
    <!-- end: page -->
@endsection
