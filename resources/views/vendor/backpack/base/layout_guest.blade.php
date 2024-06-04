<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('backpack::inc.head')
</head>
<body>
  @yield('content')
  @yield('before_scripts')
  @stack('before_scripts')
  @include('backpack::inc.scripts')
  @include('backpack::inc.alerts')
  @yield('after_scripts')
  @stack('after_scripts')
</body>
</html>
