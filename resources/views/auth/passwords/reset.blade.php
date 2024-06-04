@extends('backpack::layout_guest')

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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="m-none text-weight-semibold h6">Digite sua nova senha abaixo</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('backpack.auth.password.reset') }}">
                        {{ csrf_field() }}                    

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <div>
                                <input type="email" class="form-control input-lg" name="email" value="{{ $email ?? old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <input type="password" class="form-control" name="password" placeholder="Senha">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    {{ trans('backpack::base.change_password') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright {{ \Carbon\Carbon::now()->format('Y') }} Lançamentos Online. Todos os direitos reservados.</p>
        </div>
    </section>
    <!-- end: page -->
@endsection
