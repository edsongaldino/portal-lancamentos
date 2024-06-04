<section class="team section-light">
	  <div class="container">
	    <div class="row">
	      <div class="col-xs-12 col-sm-9">
	        <h5 class="subtitle-margin">Nossos parceiros</h5>
	        <h1>Construtoras</h1>
	      </div>
	      <div class="col-xs-12 col-sm-3">
	        <a href="#" class="navigation-box navigation-box-next" id="team-owl-next">
	          <div class="navigation-triangle"></div>
	          <div class="navigation-box-icon"><i class="jfont">&#xe802;</i></div>
	        </a>
	        <a href="#" class="navigation-box navigation-box-prev"  id="team-owl-prev">
	          <div class="navigation-triangle"></div>
	          <div class="navigation-box-icon"><i class="jfont">&#xe800;</i></div>
	        </a>
	      </div>
	      <div class="col-xs-12">
	        <div class="title-separator-primary"></div>
	      </div>
	    </div>
	  </div>
	  <div class="team-container">
	  	<div class="owl-carousel" id="team-owl">
	  		@foreach ($construtoras as $construtora)
	  		<div class="team-member-cont">
	  		  <div class="team-member">
	  		    <div class="team-photo">					
				  	<img src="{{ $construtora->getLogoUrl() }}" alt="{{ $construtora->nome_abreviado }}" />
	  		      <div class="big-triangle"></div>
	  		      <div class="big-triangle2"></div>
					<a class="big-icon big-icon-plus" 
						href="{{ $construtora->getPaginaUrl() }}">
						<i class="jfont">&#xe804;</i>
					</a>
	  		    </div>
	  		    <div class="team-name">
	  		      <h4>{{ $construtora->nome }}</h4>
	  		      <h5>{{ $construtora->empreendimentos->where('status', 'Liberada')->count() }} Empreendimentos</h5>
	  		    </div>
	  		  </div>
	  		</div>
	  		@endforeach
	  	</div>
	  </div>
	</section>