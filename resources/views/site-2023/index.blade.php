@extends('site-2023/layout')
@section('content')
<!-- Home Design -->
<section class="home-two p0">
	<div class="container-fluid p0">
		<div class="row">
			<div class="col-lg-12">
				<div class="home_two_map">
					<div class="map-canvas skin2 h500" id="contact-google-map" data-map-lat="-15.595626" data-map-lng="-56.099996" data-icon-path="{{ asset('assets/site-2023/images/logo/1.png') }}" data-map-title="Awesome Place" data-map-zoom="14"></div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Latest Properties For Sell -->
<section id="feature-property" class="latest-property bgc-f9">
	<div class="container">
		<div class="row featured_row">
			<div class="col-lg-12">
				<div class="home1-advnc-search home2 mt20">
					<form action="busca-mapa.html" method="GET">
					@csrf
					<ul class="h1ads_1st_list mb0">
						<li class="list-inline-item" style="display: none">
							<div class="search_option_two home2">
								<div class="candidate_revew_select">
									<select class="selectpicker w100 show-tick" name="modalidade" id="modalidade">
										<option disabled selected>Modalidade</option>
										<option value="Lançamento">Lançamento</option>
										<option value="Em Obra">Em Obra</option>
										<option value="Mude Já">Pronto para Morar</option>
									</select>
								</div>
							</div>
						</li>
						<li class="list-inline-item tipo-busca">
							<div class="search_option_two home2">
								<div class="candidate_revew_select">
									<select class="selectpicker w100 show-tick" name="subtipo_id" id="subtipo_id">
										<option disabled selected>Tipo</option>
										@foreach ($subtipos as $subtipo)
										<option value="{{ $subtipo->id }}">{{ $subtipo->nome }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</li>
						
						<li class="list-inline-item">
							<div class="form-group">
								<input type="text" class="form-control" id="ttexto" placeholder="Digite o nome da cidade ou estado" name="cidade">
								<input class="typeahead form-control" id="cidade" name="cidade_id" style="margin:0px auto;width:300px;" type="hidden">
								<label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
							</div>
						</li>

						<li class="list-inline-item" style="display: none">
							<div class="small_dropdown2">
								<div id="prncgs" class="btn dd_btn">
									<span>Price</span>
									<label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
								</div>
								  <div class="dd_content2 home2">
									<div class="pricing_acontent">
										<span id="slider-range-value1"></span>
										<span id="slider-range-value2"></span>
										<div id="slider"></div>
										<!-- <input type="text" class="amount" placeholder="$52,239"> 
										<input type="text" class="amount2" placeholder="$985,14">
										<div class="slider-range"></div> -->
									</div>
								  </div>
							</div>
						</li>
						<li class="custome_fields_520 list-inline-item" style="display: none">
							<div class="navbered">
								  <div class="mega-dropdown">
									<span id="show_advbtn" class="dropbtn">Advanced <i class="flaticon-more pl10 flr-520"></i></span>
									<div class="dropdown-content home2">
										  <div class="row p15">
											  <div class="col-lg-12">
												  <h4 class="text-thm3">Amenities</h4>
											  </div>
											<div class="col-xxs-6 col-sm col-lg col-xl">
												<ul class="ui_kit_checkbox selectable-list">
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck1">
															<label class="custom-control-label" for="customCheck1">Air Conditioning</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck2">
															<label class="custom-control-label" for="customCheck2">Lawn</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck3">
															<label class="custom-control-label" for="customCheck3">Swimming Pool</label>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xxs-6 col-sm col-lg col-xl">
												<ul class="ui_kit_checkbox selectable-list">
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck4">
															<label class="custom-control-label" for="customCheck4">Barbeque</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck5">
															<label class="custom-control-label" for="customCheck5">Microwave</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck6">
															<label class="custom-control-label" for="customCheck6">TV Cable</label>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xxs-6 col-sm col-lg col-xl">
												<ul class="ui_kit_checkbox selectable-list">
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck7">
															<label class="custom-control-label" for="customCheck7">Dryer</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck8">
															<label class="custom-control-label" for="customCheck8">Outdoor Shower</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck9">
															<label class="custom-control-label" for="customCheck9">Washer</label>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xxs-6 col-sm col-lg col-xl">
												<ul class="ui_kit_checkbox selectable-list">
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck10">
															<label class="custom-control-label" for="customCheck10">Gym</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck11">
															<label class="custom-control-label" for="customCheck11">Refrigerator</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck12">
															<label class="custom-control-label" for="customCheck12">WiFi</label>
														</div>
													</li>
												</ul>
											</div>
											<div class="col-xxs-6 col-sm col-lg col-xl">
												<ul class="ui_kit_checkbox selectable-list">
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck13">
															<label class="custom-control-label" for="customCheck13">Laundry</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck14">
															<label class="custom-control-label" for="customCheck14">Sauna</label>
														</div>
													</li>
													<li>
														<div class="custom-control custom-checkbox">
															<input type="checkbox" class="custom-control-input" id="customCheck15">
															<label class="custom-control-label" for="customCheck15">Window Coverings</label>
														</div>
													</li>
												</ul>
											</div>
										  </div>
										  <div class="row p15 pt0-xsd">
											  <div class="col-lg-11 col-xl-10">
												  <ul class="apeartment_area_list mb0">
													  <li class="list-inline-item">
														<div class="candidate_revew_select">
															<select class="selectpicker w100 show-tick">
																<option>Bathrooms</option>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
															</select>
														</div>
													  </li>
													  <li class="list-inline-item">
														<div class="candidate_revew_select">
															<select class="selectpicker w100 show-tick">
																<option>Bedrooms</option>
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
																<option>5</option>
																<option>6</option>
																<option>7</option>
																<option>8</option>
															</select>
														</div>
													  </li>
													  <li class="list-inline-item">
														<div class="candidate_revew_select">
															<select class="selectpicker w100 show-tick">
																<option>Year built</option>
																<option>2013</option>
																<option>2014</option>
																<option>2015</option>
																<option>2016</option>
																<option>2017</option>
																<option>2018</option>
																<option>2019</option>
																<option>2020</option>
															</select>
														</div>
													  </li>
													  <li class="list-inline-item">
														<div class="candidate_revew_select">
															<select class="selectpicker w100 show-tick">
																<option>Built-up Area</option>
																<option>Adana</option>
																<option>Ankara</option>
																<option>Antalya</option>
																<option>Bursa</option>
																<option>Bodrum</option>
																<option>Gaziantep</option>
																<option>İstanbul</option>
																<option>İzmir</option>
																<option>Konya</option>
															</select>
														</div>
													  </li>
												  </ul>
											  </div>
											  <div class="col-lg-1 col-xl-2">
												  <div class="mega_dropdown_content_closer">
													  <h5 class="text-thm text-right mt15"><span id="hide_advbtn" class="curp">Hide</span></h5>
												  </div>
											  </div>
										  </div>
									</div>
								</div>
							</div>
						</li>
						<li class="list-inline-item">
							<div class="search_option_button">
								<button type="submit" class="btn btn-thm buscar-empreendimentos">Buscar</button>
							</div>
						</li>
					</ul>
				</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container ovh">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<div class="main-title text-center mb40">
					<h2>Ofertas e Proposta Online</h2>
					<p>Confira as principais unidades em oferta e com proposta online disponível</p>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="feature_property_slider">
					@foreach($destaques as $destaque)
					<a href="/imoveis/{{ url_amigavel($destaque->subtipo->nome)}}-{{ url_amigavel($destaque->nome)}}-{{ $destaque->id }}.html" target="_blank">
					<div class="item">
						<div class="feat_property">
							<div class="thumb">
								<img class="img-whp" src="{{ $destaque->fotoPrincipal() }}" alt="{{ $destaque->nome }}">
								<div class="thmb_cntnt">
									<ul class="tag mb0">
										<li class="list-inline-item subtipo">{{ $destaque->subtipo->nome }}</li>
									</ul>
									<div class="fp_price valor-destaque">R$ {{ $destaque->valor_inicial }}<small>,00</small></div>
								</div>
							</div>
							<div class="details">
								<div class="tc_content">
									<h4>{{ $destaque->nome }}</h4>
									<p><span class="flaticon-placeholder"></span> 
										@if ($destaque->endereco)
										{{ $destaque->endereco->bairro->nome }}, {{ $destaque->endereco->cidade->nome }} - {{ $destaque->endereco->cidade->estado->nome }}
										@endif	
									</p>
								</div>
								<div class="fp_footer">
									<ul class="fp_meta float-left mb0">
										<li class="list-inline-item"><img src="{{ $destaque->construtora->getLogoUrl('125x95') }}" width="80" class="logo-construtora" alt=""></li>
									</ul>
									<div class="fp_pdate float-right">{{get_previsao_entrega($destaque)}}</div>
								</div>
							</div>
						</div>
					</div>
					</a>
					@endforeach

				</div>
			</div>
		</div>
	</div>
</section>

<!-- Our Blog -->
<section class="our-blog pb0">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3">
				<div class="main-title text-center">
					<h2>Artigos e Lançamentos</h2>
					<p>Confira as pricipais novidades do mercado imobiliário</p>
				</div>
			</div>
		</div>
		<div class="row">

			@foreach($noticias as $noticia)
			
			<div class="col-md-6 col-lg-4 col-xl-4">
				<div class="for_blog feat_property home9">
					<div class="thumb">
						<a href="{{ $noticia->getUrl() }}"><img class="img-whp" src="/uploads/{{ $noticia->arquivo }}" alt="{{ $noticia->titulo }}"></a>
					</div>
					<div class="details">
						<div class="tc_content">
							<p class="text-thm">{{ mb_strtoupper($noticia->titulo) }}</p>
							<h4 class="resumo">{{ substr($noticia->resumo, 0, 100) }}...</h4>
						</div>
						<div class="fp_footer">
							
						</div>
					</div>
				</div>
			</div>
			
			@endforeach
			
		</div>
	</div>
</section>

@endsection