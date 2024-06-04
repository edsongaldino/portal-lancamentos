@extends('backpack::layout')

@section('header')
<header class="page-header">
  <h2>Publicações</h2>

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

  <div class="col-sm-12">
    <div class="row m-b-10">
        <div class="hidden-print with-border">
            <a href="{{ route('publicacoes.adicionar') }}" class="btn btn-primary ladda-button btn-adicionar" data-style="zoom-in"><span class="ladda-label"><i class="fa fa-plus"></i> Adicionar Publicação</span></a>
        </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <section class="panel">
        <header class="panel-heading">
          <div class="panel-actions">
            <a href="#" class="fa fa-caret-down"></a>
            <a href="#" class="fa fa-times"></a>
          </div>

          <h2 class="panel-title">Publicações e Artigos</h2>
        </header>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table mb-none publicacoes-lista">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Título</th>
                  <th>Data</th>
                  <th>Fonte</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($publicacoes as $publicacao)
                  <tr>
                    <td>{{ $publicacao->id }}</td>
                    <td>{{ $publicacao->titulo }}</td>
                    <td>{{ $publicacao->data }}</td>
                    <td>{{ $publicacao->fonte }}</td>
                    <td class="actions-hover icones">
                      <a href="{{ url("admin/publicacao/$publicacao->id/editar")  }}"><i class="fa fa-pencil"></i></a>
                      <a onclick="ExcluirPublicacao({{ $publicacao->id }})" class="delete-row excluir-publicacao"><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
  <script src="/assets/javascripts/publicacoes/index.js"></script>
@endsection