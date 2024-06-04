@extends('backpack::layout')
@section('header')
<header class="page-header">
  <h2>APP Facilità</h2>
  
  <div class="right-wrapper pull-right">
    <ol class="breadcrumbs">
      <li>
        <a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a>
      </li>
      
      <li>
        <a href="{{ route('facilita') }}">Facilita</a>
      </li>
    </ol>
    
    <a class="sidebar-right-toggle" href="javascript:history.back()"><i class="fa fa-chevron-left"></i></a>
  </div>
</header>
@endsection

@section('content')

@endsection

@push('after_styles')
<link rel="stylesheet" href="/assets/vendor/select2/css/select2.css" />
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script type="text/javascript">
        $('[data-toggle="tooltip"]').tooltip();
    </script>
@endpush

@push('after_scripts')
    <script src="/assets/vendor/select2/js/select2.js"></script>
    <script src="/assets/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="/assets/javascripts/ui-elements/examples.modals.js"></script>
@endpush