@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>{{ trans('backpack::base.my_account') }}</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>

      <li>
        <a href="{{ route('perfil-usuario') }}">Meu perfil</a>
      </li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')
<!-- start: page -->

<div class="row">
  <div class="col-md-4 col-lg-3">
    <section class="panel">
      <div class="panel-body">
        <div class="thumb-info mb-md">
          @if (Auth::user()->foto)
          <img src="{{ url(Auth::user()->foto) }}" class="rounded img-responsive" alt="{{ Auth::user()->foto }}">
          @else
          <img src="{{ url('assets/images/user-sem-foto.jpg') }}" style="width: 100%;">
          @endif
          <div class="thumb-info-title">
            <span class="thumb-info-inner">{{ Auth::user()->name }}</span>
            <span class="thumb-info-type">
              @foreach (Auth::user()->getRoleNames() as $role)
              {{ $role }}
              @endforeach
            </span>
          </div>
        </div>

        <div class="widget-toggle-expand mb-md">
          <div class="widget-header">
            <h6>Complete seu perfil</h6>
            <div class="widget-toggle">+</div>
          </div>
          @php
          $percentual = 0;
          $percentual = percentual_perfil('usuario', Auth::user()->id);
          @endphp
          <div class="widget-content-collapsed">
            <div class="progress progress-xs light">
              <div class="progress-bar" role="progressbar" aria-valuenow="{{ $percentual }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $percentual }}%;">
                {{ $percentual }}%
              </div>
            </div>
          </div>
          <div class="widget-content-expanded">
            <ul class="simple-todo-list">
              @foreach ($perfil as $item)
              <li @if ($item['completo'] == 'S')class="completed"@endif>{{ $item['nome'] }}</li>
              @endforeach
            </ul>
          </div>
        </div>

        <hr class="dotted short">

        @if (Auth::user()->perfil_profissional != null)
        <h6 class="text-muted">Seu perfil profissional</h6>
        <p>{{ Auth::user()->perfil_profissional }}</p>
        @endif
      </div>
    </section>
  </div>
  <div class="col-md-8 col-lg-9">
    <div class="panel-group" id="accordion2">
      <div class="panel panel-accordion panel-accordion-primary">
        <div class="panel-heading">
          <h4 class="panel-title">
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse2One" aria-expanded="false">
              <i class="fa fa-user"></i> Meu Perfil
            </a>
          </h4>
        </div>
        <div id="collapse2One" class="accordion-body collapse in">
          <div class="panel-body">
            <form id="dados-usuario" class="form-horizontal form-bordered" enctype="multipart/form-data">
              <div class="form-group">
                <label class="col-md-2 control-label">Nome</label>
                <div class="col-md-10">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </span>
                    <input name="name" type="text" placeholder="Nome completo" class="form-control" value="{{ Auth::user()->name }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">CPF</label>
                <div class="col-md-7">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-barcode"></i>
                    </span>
                    <input name="cpf" id="fc_inputmask_1" data-plugin-masked-input data-input-mask="999.999.999-99" placeholder="" class="form-control cpf" value="{{ Auth::user()->cpf }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Data de Nasc.</label>
                <div class="col-md-6">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <input name="data_nascimento" id="date" data-plugin-masked-input data-input-mask="99/99/9999" placeholder="__/__/____" class="form-control date" value="
                    @if (Auth::user()->data_nascimento)
                    {{ Auth::user()->data_nascimento }}
                    @endif">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Celular</label>
                <div class="col-md-7 control-label">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </span>
                    <input name="celular" id="phone" data-plugin-masked-input data-input-mask="(99) 99999-9999" placeholder="(12) 1234-1234" class="form-control celular" value="{{ Auth::user()->celular }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Whatsapp</label>
                <div class="col-md-6 control-label">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-whatsapp"></i>
                    </span>
                    <input name="whatsapp" id="phone" data-plugin-masked-input data-input-mask="(99) 99999-9999" placeholder="(23) 1234-1234" class="form-control celular" value="{{ Auth::user()->whatsapp }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">E-mail</label>
                <div class="col-md-10 control-label">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-envelope"></i>
                    </span>
                    <input name="email" id="email" type="email" class="form-control" value="{{ Auth::user()->email }}">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label">Senha</label>
                <div class="col-md-4 control-label">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </span>
                    <input name="password" id="password" type="password" class="form-control" value="">
                  </div>
                </div>
                <label class="col-md-2 control-label">Confirmar Senha</label>
                <div class="col-md-4 control-label">
                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-lock"></i>
                    </span>
                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" value="">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-md-2 control-label" for="textareaDefault">Perfil profissional</label>
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-addon">
                        <i class="fa fa-id-card-o"></i>
                        </span>
                        <textarea name="perfil_profissional" class="form-control textarea" rows="5" data-plugin-maxlength maxlength="140">{{ Auth::user()->perfil_profissional }}</textarea>
                    </div>
                </div>
              </div>


              <div class="form-group">
                <label class="col-md-2 control-label">Foto</label>
                <div class="col-md-10 control-label">
                  <div class="container">
                    <div class="avatar-upload">
                      <div class="avatar-edit">
                        <input name="foto" type='file' class="imagem" id="campoFotoUsuario" data-id="#fotoUsuario"/>
                        <label for="campoFotoUsuario"></label>
                      </div>
                      @if (Auth::user()->foto)
                      <div class="avatar-preview">
                        <div id="fotoUsuario" style="background-image: url({{ url(Auth::user()->foto) }});">
                        </div>
                      </div>
                      @else
                      <div class="avatar-preview">
                        <div id="fotoUsuario">
                        </div>
                      </div>
                      @endif
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-12">
                  <button class="btn btn-success salvar-dados" type="button" id="salvar-dados-usuario">Salvar dados</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end: page -->

<!-- Specific Page Vendor -->
<script src="/assets/vendor/jquery-autosize/jquery.autosize.js"></script>
<script src="/assets/javascripts/perfil-usuario/index.js"></script>
@endsection
