<div class="content-container animated fadeInUp teste-bg" style="padding: 0;">
  <div class="entry-main" style="padding: 0;">
    <div class="thumb-featured teste001" style="margin-bottom: 0;">
      <!--
      <a href="ofertas/black-friday-empreendimentos-com-descontos-incriveis.html">
        <div class="banner-oferta"><img src="/assets/images/black-friday/banner-mobile-black-friday.png" alt=""></div>
      </a>
      -->
      <section class="site-main__search-property search-property">
        <div class="site-content-wrapper">
          <form class="js-searchForm index" id="form_busca" name="form_busca" method="get" action="/resultado-busca">
            <fieldset class="js-searchByLocation">
              <div class="search-property__search-box search-box">
                <div class="box-check-busca" id="busca-geral" style="display:block">

                  <div class="item-checkbox">
                    <label for="tipo_busca_apartamento">
                      <input type="checkbox" class="item-check" name="subtipo_id_multiplo[]" id="tipo_busca_apartamento" value="1">
                      <img class="icone-busca" id="icone-busca-ap" src="/site/m/images/icones/apartamento-icon-index.png" width="80" height="60" style="display:block;">
                    </label>
                  </div>
                  <div class="item-checkbox">
                    <label for="tipo_busca_condominio">
                      <input type="checkbox" class="item-check" name="subtipo_id_multiplo[]" id="tipo_busca_condominio" value="3">
                      <img class="icone-busca" id="icone-busca-cf-des" src="/site/m/images/icones/condominio-icon-index.png" width="80" height="60" style="display:block;">
                    </label>
                  </div>
                  <div class="item-checkbox">
                    <label for="tipo_busca_comercial">
                      <input type="checkbox" class="item-check" name="subtipo_id_multiplo[]" id="tipo_busca_comercial" value="2">
                      <img class="icone-busca" id="icone-busca-cm-des" src="/site/m/images/icones/comercial-icon-index.png" width="80" height="60" style="display:block;">
                    </label>
                  </div>
                  <div class="item-checkbox">
                    <label for="tipo_busca_loteamento">
                      <input type="checkbox" class="item-check" name="subtipo_id_multiplo[]" id="tipo_busca_loteamento" value="4">
                      <img class="icone-busca" id="icone-busca-lt-des" src="/site/m/images/icones/loteamento-icon-index.png" width="80" height="60" style="display:block;">
                    </label>
                  </div>
                </div>

                <div class="search-box__full search-box--where campo-select">
                  <span class="icon animated icon-geolocation-on js-findGeolocation hide"></span>
                  <select name="cidade_busca" id="cidade_busca" class="search-box-select">
                    <option value="" selected>Cidade</option>
                    @foreach (get_cidades() as $cidade)
                    <option value="{{ $cidade->id }}">{{ $cidade->nome }} ({{ $cidade->estado->uf }})</option>
                    @endforeach
                  </select>
                </div>
                <div class="search-box__full search-box--where campo-texto" id="busca-geral" style="display:block">
                  <span class="icon animated icon-geolocation-on js-findGeolocation hide"></span>
                  <input type="text" id="busca_rapida" name="busca_rapida" class="search-box__input js-searchBoxInput" placeholder="Bairro, Empreendimento">
                </div>
                <div class="search-box__full search-box--now">
                  <input type="submit" name="buscar" id="buscar" class="icon-search search-property__button js-searchBoxButtonLocation index" value="Buscar">
                </div>
                
              </div>
            </fieldset>
          </form>
        </div>
      </section>
    </div>
  </div>
</div>
