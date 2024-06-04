@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>Adicionar Publicação</h2>

  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>

      <li>
        <a href="{{ route('publicacoes') }}">Publicações</a>
      </li>
    </ol>

    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                        <a href="#" class="fa fa-times"></a>
                    </div>

                    <h2 class="panel-title">Editar Publicação</h2>
                </header>
                <div class="panel-body">
                    <form class="form-horizontal form-bordered form-bordered form-publicacao" id="FormEditar" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="{{ $publicacao->id ?? '' }}">  
                        @include('admin.publicacoes.form')
                        <div class="form-group">
                            <div class="col-md-12">
                                <button class="btn btn-success editar-publicacao" type="submit" id="editar-publicacao">Salvar dados</button>     
                            </div>
                        </div>

                    </form>
                </div>
            </section>
        </div>
    </div>

@endsection