
<div class="fotos-empreendimento">

    @php
        $fotos = $empreendimento->fotos->where('planta_id', 0)->where('planta_id', null)->where('status', 'Liberada');
    @endphp
    @foreach($fotos AS $foto)
        <a data-fancybox="gallery" href="{{ $foto->getUrl('original') }}" data-caption="{{ $foto->nome }}"></a>
    @endforeach



    @php
        $fotos_decorado = $empreendimento->fotos->where('tipo', 'Decorado')->where('status', 'Liberada');
    @endphp
    @foreach($fotos_decorado AS $decorado)
        <a data-fancybox="galleryDecorado" href="{{ $decorado->getUrl('original') }}" data-caption="{{ $decorado->nome }}"></a>
    @endforeach

</div>