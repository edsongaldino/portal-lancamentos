@extends('site-2023/layout')
@section('content')
<!-- Listing Grid View -->
<section class="our-listing bgc-f7 pb30-991">
	<div class="container portal">

		<div class="row">
			<div class="col-lg-6">
				<div class="breadcrumb_content style2 mb0-991">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active text-thm" aria-current="page">Lista empreendimentos</li>
					</ol>
					<h2 class="breadcrumb_title">Sua busca retornou {{ $empreendimentos->count() }} empreendimentos</h2>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="listing_list_style mb20-xsd tal-991">
					<ul class="mb0">
						<li class="list-inline-item"><a href="busca-mapa.html"><span class="fa fa-th-large"></span></a></li>
						<li class="list-inline-item"><a href="resultado-busca.html"><span class="fa fa-th-list"></span></a></li>
					</ul>
				</div>
				<div class="dn db-991 mt30 mb0">
					<div id="main2">
						<span id="open2" class="flaticon-filter-results-button filter_open_btn style2"> Mostrar Filtro</span>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-xl-4">
				<div class="sidebar_listing_grid1 dn-991">
					<div class="sidebar_listing_list">
						<div class="sidebar_advanced_search_widget">
							<ul class="sasw_list mb0">
								<li class="search_area">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputEmail" placeholder="Localização">
										<label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
									</div>
								</li>
								<li>
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option selected disabled>Tipo</option>
												@foreach ($subtipos as $subtipo)
												<option value="{{ $subtipo->id }}">{{ $subtipo->nome }}</option>
												@endforeach
											</select>
										</div>
									</div>
								</li>
								<li style="display:none;">
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option>Property Type</option>
												<option>Apartment</option>
												<option>Bungalow</option>
												<option>Condo</option>
												<option>House</option>
												<option>Land</option>
												<option>Single Family</option>
											</select>
										</div>
									</div>
								</li>
								<li style="display:none;">
									<div class="small_dropdown2">
										<div id="prncgs" class="btn dd_btn">
											<span>Price</span>
											<label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
										</div>
										  <div class="dd_content2">
											<div class="pricing_acontent">
												<!-- <input type="text" class="amount" placeholder="$52,239">
												<input type="text" class="amount2" placeholder="$985,14">
												<div class="slider-range"></div> -->
												<span id="slider-range-value1"></span>
												<span class="mt0" id="slider-range-value2"></span>
												<div id="slider"></div>
											</div>
										  </div>
									</div>
								</li>

								<li class="min_area style2 list-inline-item">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputName2" placeholder="Min Valor">
									</div>
								</li>
								<li class="max_area list-inline-item">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputName3" placeholder="Max Valor">
									</div>
								</li>

								<li style="display:none;">
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option>Bathrooms</option>
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
											</select>
										</div>
									</div>
								</li>
								<li style="display:none;">
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option>Bedrooms</option>
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
											</select>
										</div>
									</div>
								</li>
								<li style="display:none;">
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option>Garages</option>
												<option>Yes</option>
												<option>No</option>
												<option>Others</option>
											</select>
										</div>
									</div>
								</li>
								<li>
									<div class="search_option_two">
										<div class="candidate_revew_select">
											<select class="selectpicker w100 show-tick">
												<option>Modalidade</option>
												<option>Lançamento</option>
												<option>Em Obra</option>
												<option>Pronto pra Morar</option>
											</select>
										</div>
									</div>
								</li>
								<li class="min_area style2 list-inline-item">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputName2" placeholder="Min Area">
									</div>
								</li>
								<li class="max_area list-inline-item">
									<div class="form-group">
										<input type="text" class="form-control" id="exampleInputName3" placeholder="Max Area">
									</div>
								</li>
								<li>
									  <div id="accordion" class="panel-group">
										<div class="panel">
											  <div class="panel-heading">
												  <h4 class="panel-title">
													<a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i> Busca avançada</a>
												</h4>
											  </div>
											<div id="panelBodyRating" class="panel-collapse collapse">
												<div class="panel-body row">
													  <div class="col-lg-12">
														<ul class="ui_kit_checkbox selectable-list float-left fn-400">
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck16">
																	<label class="custom-control-label" for="customCheck16">Piscina</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck17">
																	<label class="custom-control-label" for="customCheck17">Quadra de tênis</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck18">
																	<label class="custom-control-label" for="customCheck18">Quandra Poliesportiva</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck19">
																	<label class="custom-control-label" for="customCheck19">Campo Socyte</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck20">
																	<label class="custom-control-label" for="customCheck20">Pista de caminhada</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck21">
																	<label class="custom-control-label" for="customCheck21">PetPark</label>
																</div>
															</li>
														</ul>
														<ul class="ui_kit_checkbox selectable-list float-right fn-400">
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck24">
																	<label class="custom-control-label" for="customCheck24">Segurança 24h</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck25">
																	<label class="custom-control-label" for="customCheck25">Sauna</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck26">
																	<label class="custom-control-label" for="customCheck26">Lago</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck27">
																	<label class="custom-control-label" for="customCheck27">Portaria 24h</label>
																</div>
															</li>
															<li>
																<div class="custom-control custom-checkbox">
																	<input type="checkbox" class="custom-control-input" id="customCheck28">
																	<label class="custom-control-label" for="customCheck28">Bicicletário</label>
																</div>
															</li>

														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="search_option_button">
										<button type="submit" class="btn btn-block btn-thm">Filtrar</button>
									</div>
								</li>
							</ul>
						</div>
					</div>

				</div>
			</div>
			<div class="col-md-12 col-lg-8">
				<div class="row">
					<div class="grid_list_search_result">
						<div class="col-sm-12 col-md-4 col-lg-4 col-xl-5">
							<div class="left_area tac-xsd">
								<p>{{ $empreendimentos->count() }} empreendimentos encontratos</p>
							</div>
						</div>
						<div class="col-sm-12 col-md-8 col-lg-8 col-xl-7">
							<div class="right_area text-right tac-xsd">
								<ul>
									<li class="list-inline-item"><span class="shrtby">Ordenar por:</span>
										<select class="selectpicker show-tick">
											<option>Valor (-)</option>
											<option>Valor (+)</option>
											<option>Previsão de Entrega (-)</option>
											<option>Previsão de Entrega (+)</option>
										</select>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="row">


					@foreach ($empreendimentos as $empreendimento)
					<div class="col-lg-12">
						<div class="feat_property list">
							<div class="thumb">
								<div class="fp_single_item_slider">
									@foreach($empreendimento->getFotosCarrosselMapa() as $foto)
									<div class="item">
										<a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank"><img class="img-whp" src="{{ $foto->getUrl() }}" alt="{{ $foto->nome }}"></a>
									</div>
									@endforeach
								</div>
							</div>
							<div class="details">
								<div class="tc_content">
									<div class="dtls_headr">
										<ul class="tag">
											<li class="list-inline-item"><a href="#"><i class="fas fa-building"></i> {{ $empreendimento->subtipo->nome }}</a></li>
											<li class="list-inline-item"><a href="#">{{ $empreendimento->modalidade }}</a></li>
										</ul>
										<a class="fp_price" href="#">R$ {{ $empreendimento->valor_inicial }}<small>,00</small></a>
									</div>
									<p class="text-thm">{{ $empreendimento->variacao->nome }}</p>
									<h4>{{ $empreendimento->nome }}</h4>
									<p><span class="flaticon-placeholder"></span>
										@if ($empreendimento->endereco)
										{{ $empreendimento->endereco->bairro->nome }}, {{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->cidade->estado->nome }}
										@endif									
									</p>
									<ul class="prop_details mb0">
										<li class="list-inline-item"><a href="#"><i class="fas fa-bed"></i> {!! qtd_dormitorio($empreendimento, true) !!}</a></li>
										<li class="list-inline-item"><a href="#"><i class="fas fa-toilet"></i> {!! qtd_banheiro($empreendimento) !!}</a></li>
										<li class="list-inline-item"><a href="#"><i class="fas fa-ruler-combined"></i> {{ qtd_metragem($empreendimento)}} m<sup>2</sup></a></li>
									</ul>
								</div>
								<div class="fp_footer">
									<ul class="fp_meta float-left mb0">
										<li class="list-inline-item"><a href="#"><img src="{{ $empreendimento->construtora->getLogoUrl('125x95') }}" width="80" alt=""></a></li>
									</ul>
									<div class="fp_pdate float-right">{{get_previsao_entrega($empreendimento)}}</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach


					<div class="col-lg-12 mb30">
						<div class="mbp_pagination">
							<ul class="page_navigation">
								{{ $empreendimentos->links() }}
							</ul>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>
</section>
@endsection