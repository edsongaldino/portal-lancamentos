@extends('backpack::layout_guest')

@section('content')
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo pull-left">
                <img src="/assets/images/logo.png" height="54" alt="Admin" />
            </a>

            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Acesso Painel</h2>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('backpack.auth.login') }}">
                        {!! csrf_field() !!}
                        <div class="form-group mb-lg">
                            <label>{{ config('backpack.base.authentication_column_name') }}</label>
                            <div class="input-group input-group-icon">
                                <input @if(isset($username))name="{{ $username }}" value="{{ old($username) }}" @else name="email" @endif type="text" class="form-control input-lg" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-user"></i>
                                    </span>
                                </span>
                            </div>
                            @if (isset($username) && $errors->has($username))
                                <span class="help-block">
                                    <strong>{{ $errors->first($username) }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group mb-lg">
                            <div class="clearfix">
                                <label class="pull-left">Senha</label>
                                @if (backpack_users_have_email())
                                <a href="{{ route('backpack.auth.password.reset') }}" class="pull-right">{{ trans('backpack::base.forgot_your_password') }}</a>
                                @endif
                            </div>
                            <div class="input-group input-group-icon">
                                <input name="password" type="password" class="form-control input-lg" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input id="RememberMe" name="remember" type="checkbox"/>
                                    <label for="RememberMe">Manter logado</label>
                                </div>
                            </div>
                            <div class="col-sm-4 text-right">
                                <button type="submit" class="btn btn-primary hidden-xs">Acessar</button>
                                <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Acessar</button>
                            </div>
                        </div>

                        <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                            <span>ou</span>
                        </span>
                        
                        @if (config('backpack.base.registration_open'))
                        <p class="text-center">Ainda não possui uma conta? <a href="{{ route('backpack.auth.register') }}">Clique aqui!</a></p>
                        @endif

                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }}. Todos os direitos reservados.</p>

        </div>
    </section>
    <!-- end: page -->
@endsection
