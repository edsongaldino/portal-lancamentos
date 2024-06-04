<!DOCTYPE html>
<html dir="ltr" lang="pt-br">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Ofertas imperdíveis de diversos empreendimentos na planta e prontos pra morar">
<meta name="keywords" content="lançamentos online, lançamentos imobiliários, apartamento em cuiabá, apartamento novo, imoveis mt, imoveis novos cuiabá">
<meta name="author" content="Lançamentos Online">
<!-- css file -->
<link rel="stylesheet" href="{{ asset('assets/site-2023/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/site-2023/css/style.css') }}">
<!-- Responsive stylesheet -->
<link rel="stylesheet" href="{{ asset('assets/site-2023/css/responsive.css') }}">
<link rel="stylesheet" href="{{ asset('assets/site-2023/css/custom.css') }}">
<!-- Title -->
<title>Lançamentos Online - O seu novo lar está aqui!</title>
<!-- Favicon -->
<link href="{{ asset('site/favicon.ico') }}" sizes="128x128" rel="shortcut icon" type="image/x-icon" />
<link href="{{ asset('site/favicon.ico') }}" sizes="128x128" rel="shortcut icon" />

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
<div class="wrapper">
	<div class="preloader"></div>

	<!-- Main Header Nav -->
	<header class="header-nav menu_style_home_one style2 navbar-scrolltofixed stricky main-menu">
		<div class="container-fluid p0">
		    <!-- Ace Responsive Menu -->
		    <nav>
		        <!-- Menu Toggle btn-->
		        <div class="menu-toggle">
		            <a href="/pagina-inicial.html"><img class="nav_logo_img img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png"></a>
		            <button type="button" id="menu-btn">
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		                <span class="icon-bar"></span>
		            </button>
		        </div>
		        <a href="/pagina-inicial.html" class="navbar_brand float-left dn-smd">
		            <img class="logo1 img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png">
		            <img class="logo2 img-fluid" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png">
		        </a>
		        <!-- Responsive Menu Structure-->
		        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
		        <ul id="respMenu" class="ace-responsive-menu text-right" data-menu-style="horizontal">
		            <li>
						<a href="/empreendimentos/1-apartamentos.html"><span class="title"><i class="fas fa-building"></i> Apartamentos</span></a>
					</li>
					<li>
						<a href="/empreendimentos/2-salascomerciais.html"><span class="title"><i class="fas fa-store"></i> Salas Comerciais</span></a>
					</li>
					<li>
						<a href="/empreendimentos/3-condominiofechado.html"><span class="title"><i class="fas fa-house-damage"></i> Condomínios Horizontais</span></a>
					</li>
					<li class="cl_btn"><a href="/plataforma-lancamentos-online.html" target="_blank"><i class="fas fa-rocket"></i> Anuncie</a></li>
		        </ul>
		    </nav>
		</div>
	</header>


	<!-- Main Header Nav For Mobile -->
	<div id="page" class="stylehome1 h0">
		<div class="mobile-menu">
			<div class="header stylehome1">
				<div class="d-flex justify-content-between">
					<a class="mobile-menu-trigger" href="#menu"><img src="{{ asset('assets/site-2023/images/dark-nav-icon.svg') }}" alt=""></a>
					<a class="nav_logo_img" href="index.html"><img class="img-fluid mt20" src="{{ asset('assets/site-2023/images/header-logo.png') }}" alt="header-logo.png"></a>
					<a class="mobile-menu-reg-link" href="page-register.html"><span class="flaticon-user"></span></a>
				</div>
			</div>
		</div><!-- /.mobile-menu -->
		<nav id="menu" class="stylehome1">
			<ul>
				<li><span>Home</span>
				</li>
				<li><span>Lançamentos</span>
				</li>
				<li><span>Prontos pra Morar</span>
				</li>
				<li><span>Financiamento</span></li>
				<li class="cl_btn"><a class="btn btn-block btn-lg btn-thm circle" href="#"><span class="flaticon-building"></span> Proposta Online</a></li>
			</ul>
		</nav>
	</div>

	<!-- Listing Grid View -->
	<section id="feature-property" class="our-listing bgc-f7 pt0 pb0">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="listing_sidebar dn db-991">
						<div class="sidebar_content_details style3">
							<!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
							
							<div class="sidebar_listing_list style2 mobile_sytle_sidebar mb0">
								<div class="sidebar_advanced_search_widget">
									<h4 class="mb25">Filtrar Resultado <a class="filter_closed_btn float-right" href="#"><small>Fechar Filtro</small> <span class="flaticon-close"></span></a></h4>
									<ul class="sasw_list style2 mb0">
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
														@foreach (get_subtipos() as $subtipo)
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
														<option>Entrega</option>
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
												        	<a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i> Características</a>
												        </h4>
											      	</div>
												    <div id="panelBodyRating" class="panel-collapse collapse">
												        <div class="panel-body row">
												      		<div class="col-lg-12">
												                <ul class="ui_kit_checkbox selectable-list float-left fn-400">
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck1">
																			<label class="custom-control-label" for="customCheck1">Air Conditioning</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck4">
																			<label class="custom-control-label" for="customCheck4">Barbeque</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck10">
																			<label class="custom-control-label" for="customCheck10">Gym</label>
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
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck2">
																			<label class="custom-control-label" for="customCheck2">Lawn</label>
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
																			<input type="checkbox" class="custom-control-input" id="customCheck3">
																			<label class="custom-control-label" for="customCheck3">Swimming Pool</label>
																		</div>
												                	</li>
												                </ul>
												                <ul class="ui_kit_checkbox selectable-list float-right fn-400">
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck12">
																			<label class="custom-control-label" for="customCheck12">WiFi</label>
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
																			<input type="checkbox" class="custom-control-input" id="customCheck7">
																			<label class="custom-control-label" for="customCheck7">Dryer</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck9">
																			<label class="custom-control-label" for="customCheck9">Washer</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheck13">
																			<label class="custom-control-label" for="customCheck13">Laundry</label>
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
																			<input type="checkbox" class="custom-control-input" id="customCheck15">
																			<label class="custom-control-label" for="customCheck15">Window Coverings</label>
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
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="listing_sidebar dn-991">
						<div class="sidebar_content_details is-full-width">
							<!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
							<div class="sidebar_listing_list style2 mb0">
								<div class="sidebar_advanced_search_widget">
									<form action="busca-mapa.html" method="GET">
									@csrf
									<h4 class="mb25">Busca Avançada</h4>
									<ul class="sasw_list style2 mb0">
										<li class="search_area">
										    <div class="form-group">
										    	<input type="text" class="form-control" id="exampleInputEmail" placeholder="Localização">
										    	<label for="exampleInputEmail"><span class="flaticon-maps-and-flags"></span></label>
										    </div>
										</li>
										<li style="display:none;">
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick">
														<option>Status</option>
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
										<li>
											<div class="search_option_two">
												<div class="candidate_revew_select">
													<select class="selectpicker w100 show-tick" name="subtipo_id" id="subtipo_id">
														<option selected disabled>Tipo</option>
														@foreach (get_subtipos() as $subtipo)
														<option value="{{ $subtipo->id }}">{{ $subtipo->nome }}</option>
														@endforeach
													</select>
												</div>
											</div>
										</li>
										<li style="display:none;">
											<div class="small_dropdown2">
											    <div id="prncgs2" class="btn dd_btn">
											    	<span>Preço</span>
											    	<label for="exampleInputEmail2"><span class="fa fa-angle-down"></span></label>
											    </div>
											  	<div class="dd_content2">
												    <div class="pricing_acontent">
														<input type="text" class="amount" placeholder="R$15.000">
														<input type="text" class="amount2" placeholder="R$3.000.000">
														<div class="slider-range"></div>
												    </div>
											  	</div>
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
														<option>Garagem</option>
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
													<select class="selectpicker w100 show-tick" name="modalidade" id="modalidade">
														<option disabled selected>Modalidade</option>
														<option value="Lançamento">Lançamento</option>
														<option value="Em Obra">Em Obra</option>
														<option value="Mude já">Pronto pra Morar</option>
													</select>
												</div>
											</div>
										</li>

										<li class="min_area style2 list-inline-item">
										    <div class="form-group">
										    	<input type="text" class="form-control moeda" name="valor_min" id="valor_min" placeholder="Min Valor">
										    </div>
										</li>
										<li class="max_area list-inline-item">
										    <div class="form-group">
										    	<input type="text" class="form-control moeda" name="valor_max" id="valor_max" placeholder="Max Valor">
										    </div>
										</li>
										<li>
										  	<div id="accordion" class="panel-group">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyRating" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion"><i class="flaticon-more"></i> Características</a>
												        </h4>
											      	</div>
												    <div id="panelBodyRating" class="panel-collapse collapse">
												        <div class="panel-body row">
												      		<div class="col-lg-12">
												                <ul class="ui_kit_checkbox selectable-list float-left fn-400">
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckseguranca">
																			<label class="custom-control-label" for="customCheckseguranca">Segurança 24h</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckPortaria">
																			<label class="custom-control-label" for="customCheckPortaria">Portaria</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customChecktenis">
																			<label class="custom-control-label" for="customChecktenis">Quadra de Tênis</label>
																		</div>
												                	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckQuadra">
																			<label class="custom-control-label" for="customCheckQuadra">Quadra Poliesportiva</label>
																		</div>
												                	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckLago">
																			<label class="custom-control-label" for="customCheckLago">Lago</label>
																		</div>
												                	</li>
																	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckPiscina">
																			<label class="custom-control-label" for="customCheckPiscina">Piscina</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckCampo">
																			<label class="custom-control-label" for="customCheckCampo">Campo de Futebol</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckPista">
																			<label class="custom-control-label" for="customCheckPista">Pista de Caminhada</label>
																		</div>
												                	</li>
												                	<li>
																		<div class="custom-control custom-checkbox">
																			<input type="checkbox" class="custom-control-input" id="customCheckBike">
																			<label class="custom-control-label" for="customCheckBike">Bicicletário</label>
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
									</form>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="sidebar_switch mobile_style dn db-991 mt30 mt0-767 mb0">
						<div id="main2">
							<span id="open2" class="flaticon-filter-results-button filter_open_btn"> Ocultar Filtro</span>
						</div>
					</div>
				</div>
				<div class="col-xl-5">
					<div class="half_map_area_content mt30">
						<div class="row">
							<div class="grid_list_search_result">
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
									<div class="left_area tac-xsd">
										<p>{{ $empreendimentos->count() }} empreendimentos encontratos</p>
									</div>
								</div>
								<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 pl0 pr0">
									<div class="half_map_advsrch_navg style2 text-right tac-xsd">
										<ul>
											<li class="list-inline-item"><span class="flaticon-more"></span>
												<select class="selectpicker show-tick">
													<option>Menor valor</option>
													<option>Menor metragem</option>
													<option>Maior valor</option>
													<option>Maior metragem</option>
												</select>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12">
								<ul class="feature_property_half_clist style2 mb0">

                                    @foreach ($empreendimentos as $empreendimento)
									
                                    <li class="extrawide list-inline-item">
										<div class="feat_property home7 style4">
											<div class="thumb">
												<div class="fp_single_item_slider">
                                                    @foreach($empreendimento->getFotosCarrossel() as $foto)
													<div class="item">
														<a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank"><img class="img-whp" src="{{ $foto->getUrl() }}" alt="{{ $foto->nome }}"></a>
													</div>
                                                    @endforeach
												</div>
												<div class="thmb_cntnt style2">
													<ul class="tag mb0">
														<li class="list-inline-item txt-modalidade">{{ $empreendimento->modalidade }}</li>
													</ul>
												</div>
												<div class="thmb_cntnt style3">
													<ul class="icon mb0">
														<li class="list-inline-item"><span class="flaticon-heart"></span></li>
													</ul>
													<span class="fp_price">R$ {{ $empreendimento->valor_inicial }}
												</div>
											</div>
											<a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank">
											<div class="details">
												<div class="tc_content">
													<p class="text-thm">
														@if ($empreendimento->subtipo_id == 1)
															<i class="fa fa-building" aria-hidden="true" title="Apartamento"></i>
														@elseif ($empreendimento->subtipo_id == 2)
															<i class="fa fa-briefcase" aria-hidden="true" title="Salas Comerciais"></i>
														@else
															<i class="fa fa-home" aria-hidden="true" title="Casas em Condomínio"></i>
														@endif
														
														{{ $empreendimento->subtipo->nome }}
													</p>
													<h4>{{ $empreendimento->nome }}</h4>
													<p><span class="flaticon-placeholder"></span> {{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->estado->uf }}</p>
													@if($empreendimento->subtipo_id == 1)
													<ul class="prop_details mb0">
														<li class="list-inline-item"><span class="fa fa-bed"></span> {{ qtd_dormitorio($empreendimento) }}</li>
														<li class="list-inline-item"><span class="fa fa-car"></span> {{ qtd_vagas($empreendimento) }}</li>
														<li class="list-inline-item"><span class="fa fa-object-group"></span> {{ qtd_metragem($empreendimento)}} m<sup>2</sup></li>
													</ul>
													@elseif($empreendimento->subtipo_id == 2)
													<ul class="prop_details mb0">
														<li class="list-inline-item"><span class="fa fa-bed"></span> 3</li>
														<li class="list-inline-item"><span class="fa fa-car"></span> 2</li>
														<li class="list-inline-item"><span class="fa fa-object-group"></span> 48,32m²</li>
													</ul>
													@elseif($empreendimento->subtipo_id == 3)
													<ul class="prop_details mb0">
														<li class="list-inline-item"><span class="fa fa-bed"></span> 3</li>
														<li class="list-inline-item"><span class="fa fa-car"></span> 2</li>
														<li class="list-inline-item"><span class="fa fa-object-group"></span> 48,32m²</li>
													</ul>
													@elseif($empreendimento->subtipo_id == 4)
													<ul class="prop_details mb0">
														<li class="list-inline-item"><span class="fa fa-bed"></span> 3</li>
														<li class="list-inline-item"><span class="fa fa-car"></span> 2</li>
														<li class="list-inline-item"><span class="fa fa-object-group"></span> 48,32m²</li>
													</ul>
													@endif
												</div>
												<div class="fp_footer">
													<ul class="fp_meta float-left mb0">
														<li class="list-inline-item" title="{{ $empreendimento->construtora->nome_abreviado }}"><img src="{{ $empreendimento->construtora->getLogoUrl('260x260') }}" width="50" alt="pposter1.png"></li>
													</ul>
													<div class="fp_pdate float-right">{{ get_previsao_entrega($empreendimento) }}</div>
												</div>
											</div>
											</a>
										</div>
									</li>

                                    @endforeach

								</ul>
							</div>

                            <div class="col-lg-12 mb30">
								<div class="mbp_pagination">
									<ul class="page_navigation">
							            @if (isset($paginacao))
										{{ $paginacao->appends([
										'estado_id' => $parametros['estado_id'],
										'cidade_id' => $parametros['cidade_id'],
										'subtipo_id' => $parametros['subtipo_id'],
										'busca_rapida' => $parametros['busca_rapida'],
										'construtora_id_multiplo' => $parametros['construtora_id_multiplo'],
										'construtora_id' => $parametros['construtora_id'],
										'subtipo_id_multiplo' => $parametros['subtipo_id_multiplo'],
										'modalidade_id_multiplo' => $parametros['modalidade_id_multiplo'],
										'cidade_id_multiplo' => $parametros['cidade_id_multiplo'],
										'bairro_id_multiplo' => $parametros['bairro_id_multiplo'],
										'valor' => $parametros['valor'],
										'quarto' => $parametros['quarto'],
										'area' => $parametros['area'],
										'ordenacao' => $parametros['ordenacao'],
										])->links() }}

										@else

										{{ $empreendimentos->links() }}

										@endif
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-7">
					<div class="sidebar_switch style2 text-right dn-991">
						<div id="main2">
							<span id="open2" class="flaticon-filter-results-button sidebarClosed2 filteropen2 showBtns"> Mostrar Filtro</span>
						</div>
					</div>
					<div class="half_map_area">
						<div class="home_two_map style2">
							<div class="map-canvas skin2 half_style" id="contact-google-map" data-map-lat="-15.595626" data-map-lng="-56.099996" data-icon-path="{{ asset('assets/site-2023/images/logo/1.png') }}" data-map-title="Awesome Place" data-map-zoom="14"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<a class="scrollToHome" href="#"><i class="flaticon-arrows"></i></a>
</div>
<!-- Wrapper End -->
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery.mmenu.all.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/ace-responsive-menu.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/bootstrap-select.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/snackbar.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/simplebar.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/parallax.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/scrollto.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery-scrolltofixed-min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/jquery.counterup.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/pricing-slider.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/timepicker.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLZYFMbNKXu2gyC_yxbdEDGxA6G0LSNu8&callback=initMap"type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('assets/site-2023/js/google-maps.js') }}"></script>
<!-- Custom script for all pages -->
<script type="text/javascript" src="{{ asset('assets/site-2023/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascripts/mascaras/jquery.mask.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/javascripts/mascaras/jquery.maskMoney.js') }}"></script>


<script>
$('.moeda').maskMoney({thousands: '.', decimal: ','});
/* New Map CustomCode */
"use strict";
function gMapHome () {
  if ($('.map-canvas').length) {
    $('.map-canvas').each(function () {
      // getting options from html
      var Self = $(this);
      var mapName = Self.attr('id');
      var mapLat = Self.data('map-lat');
      var mapLng = Self.data('map-lng');
      var iconPath = Self.data('icon-path');
      var mapZoom = Self.data('map-zoom');
      var mapTitle = Self.data('map-title');

      var styles = [
        {"featureType": "all", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
        {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#222222"} ] },
        {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
        {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
        {"lightness": 45 } ] },
        {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
        {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road.local", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
        {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "water", "elementType": "all", "stylers": [{"color": "#ffe807"},
        {"visibility": "on"} ] } ];

      if ($(this).hasClass('skin1')) {
        var iconPath = 'assets/site-2023/images/resource/map-marker.png';
        var styles = [
        {"featureType": "all", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
        {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
        {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
        {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
        {"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
        {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road.local", "elementType": "labels.text", "stylers": [{"visibility": "off"} ] },
        {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "water", "elementType": "all", "stylers": [{"color": "#ffe807"}, {"visibility": "on"} ] } ];
      }
      if ($(this).hasClass('skin2')) {
        var iconPath = 'assets/site-2023/images/resource/map-marker.png';
        var styles = [
        {"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "on"} ] },
        {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#222222"} ] },
        {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "green"} ] },
        {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 }, {"lightness": 45 } ] },
        {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
        {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
        {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "water", "elementType": "all", "stylers": [{"color": "blue"}, {"visibility": "on"}]}];
      }
      if ($(this).hasClass('skin3')) {
        var iconPath = 'assets/site-2023/images/resource/map-marker.png';
        var styles = [{"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "off"} ] },
        {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
        {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
        {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
        {"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
        {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
        {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "water", "elementType": "all", "stylers": [{"color": "#13a0b2"}, {"visibility": "on"} ] } ];
      }
      if ($(this).hasClass('skin4')) {
        var iconPath = 'assets/site-2023/images/resource/map-marker.png';
        var styles = [{"featureType": "all", "elementType": "labels", "stylers": [{"visibility": "off"} ] },
        {"featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{"color": "#444444"} ] },
        {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"} ] },
        {"featureType": "poi", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "road", "elementType": "all", "stylers": [{"saturation": -100 },
        {"lightness": 45 } ] }, {"featureType": "road.highway", "elementType": "all", "stylers": [{"visibility": "simplified"} ] },
        {"featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{"visibility": "off"} ] },
        {"featureType": "transit", "elementType": "all", "stylers": [{"visibility": "off"} ] },
        {"featureType": "water", "elementType": "all", "stylers": [{"color": "#44e2ff"}, {"visibility": "on"} ] } ];
      }

      // if zoom not defined the zoom value will be 15;
      if (!mapZoom) {
        var mapZoom = 12;
      };
      // init map
      var map;
      map = new GMaps({
          div: '#'+mapName,
          scrollwheel: false,
          lat: mapLat,
          lng: mapLng,
          styles: styles,
          zoom: mapZoom
      });
      // if icon path setted then show marker
      if(iconPath) {
		@foreach ($empreendimentos as $empreendimento)
        map.addMarker({
            icon: iconPath,
            lat: {{ $empreendimento->endereco->latitude ?? '-15.595626' }},
            lng: {{ $empreendimento->endereco->longitude ?? '-56.099996' }},
            title: 'Tenby ',
            infoWindow: {
            content:
            '<a href="/imoveis/{{ url_amigavel($empreendimento->subtipo->nome)}}-{{ url_amigavel($empreendimento->nome)}}-{{ $empreendimento->id }}.html" target="_blank"><img src="{{ $empreendimento->fotoPrincipal() }}" alt="fp1.jpg"/> <h5>{{ $empreendimento->nome }}</h5> <h4>{{ $empreendimento->subtipo->nome }}</h4> <p>{{ $empreendimento->endereco->bairro->nome }}, {{ $empreendimento->endereco->cidade->nome }} - {{ $empreendimento->endereco->estado->uf }}</p> <p><span><span class="fa fa-bed"></span> 3</span> <span><span class="fa fa-car"></span> 3</span> <span><span class="fa fa-object-group"></span> 48,32m²</span></p></a>'
          }
        });
        @endforeach
      }
    });
  };
}

// Dom Ready Function
jQuery(document).on('ready', function () {
  (function ($) {
    // add your functions
    gMapHome();
  })(jQuery);
});
</script>
</body>
</html>