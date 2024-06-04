<section class="section-dark">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-lg-12">
				<h5 class="subtitle-margin">Mercado Imobiliário</h5>
				<h1 class="">Artigos</h1>
			</div>
			<div class="col-xs-12">
				<div class="title-separator-primary"></div>
			</div>
		</div>
	</div>
	<div class="container blog-grid1-container">
		<div class="row">
			@foreach($noticias as $noticia)
			<div class="col-md-12 col-lg-6 blog-grid1-left-col @if($loop->iteration > 2) margin-top-15 @endif">
				<article class="blog-grid1-item zoom-cont">
					@if($loop->iteration < 3)
					@include('site/home/desktop/noticia/foto')
					@include('site/home/desktop/noticia/conteudo')
					@else
					@include('site/home/desktop/noticia/conteudo')
					@include('site/home/desktop/noticia/foto')
					@endif
				</article>
			</div>	      
			@endforeach
		</div>
	</div>
</section>