<!-- Modal -->
<div class="modal fade" id="ModalContatoConstrutora" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header form">
        <h5 class="modal-title" id="exampleModalCenterTitle">Fale com a construtora</h5>
        <button type="button" class="close modal-form" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form action="/empreendimento/enviar-contato-cliente" name="FormContatoConstrutora" id="FormContatoConstrutora" method="POST">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="input-field">
                  <span class="icons icone_campo">
                    <i class="fa fa-user"></i>
                  </span>
                  <input name="nome" type="text" class="input-form with-icons input-font-maior" placeholder="Nome completo" value="" required/>
                </div>

                <div class="input-field">
                  <span class="icons icone_campo">
                    <i class="fa fa-envelope"></i>
                  </span>
                  <input type="email" name="email" id="email" placeholder="E-mail" class="input-form with-icons input-font-maior" required="required" value="">
                </div>

                <div class="input-field">
                  <span class="icons icone_campo">
                    <i class="fa fa-phone"></i>
                  </span>
                  <input type="text" placeholder="Telefone" name="telefone" id="telefone_form" class="input-form with-icons telefone phone" maxlength="16" required="required" value="">
                </div>

                <div class="input-field no-border">
                  <span class="icons icone_campo">
                    <i class="fa fa-calendar"></i>
                  </span>
                  <select class="search-box__combo js-businessSelect" name="previsao" id="previsao" required="required">
                    <option class="item" value="" selected="selected">Qual a sua previsão de compra?</option>
                    <option class="item" value="Imediata">Imediata</option>
                    <option class="item" value="Até 90 dias">Até 90 dias</option>
                    <option class="item" value="6 meses à 1 ano">6 meses à 1 ano</option>
                    <option class="item" value="1 ano ou mais">1 ano ou mais</option>
                  </select>
                </div>

                <div class="input-field no-border">
                  <span class="icons icone_campo">
                    <i class="fa fa-check"></i>
                  </span>
                  <select class="search-box__combo js-businessSelect" name="interesse" id="interesse" required="required">
                    <option class="item" value="" selected="selected">O que mais te agradou neste produto?</option>
                    <option class="item" value="Preço">Preço</option>
                    <option class="item" value="Localização">Localização</option>
                    <option class="item" value="Área de Lazer">Área de Lazer</option>
                    <option class="item" value="Planta do imóvel">Planta do imóvel</option>
                    <option class="item" value="Previsão de entrega">Previsão de entrega</option>
                  </select>
                </div>

                <div class="input-field no-border">
                  <span class="icons icone_campo">
                    <i class="fa fa-money"></i>
                  </span>
                  <select class="search-box__combo js-businessSelect" name="renda" id="renda" required="required">
                    <option class="item" value="" selected="selected">Qual a sua renda? R$</option>
                    <option class="item" value="Até 3.000,00">Até 3.000</option>
                    <option class="item" value="de 3.000 à 5.000">de 3.000 à 5.000</option>
                    <option class="item" value="de 5.000 à 7.000">de 5.000 à 7.000</option>
                    <option class="item" value="de 7.000 à 10.000">de 7.000 à 10.000</option>
                    <option class="item" value="de 10.000 à 15.000">de 10.000 à 15.000</option>
                    <option class="item" value="Acima de 15.000">Acima de 15.000</option>
                  </select>
                </div>

                <div class="input-field">
                  <span class="icons">
                    <i class="fa fa-comment"></i>
                  </span>
                  <textarea placeholder="Mensagem" name="mensagem" id="mensagem" class="input-form with-icons textarea" required="required">Olá, tenho interesse no empreendimento {{ $empreendimento->nome }}. Aguardo o contato. Obrigado.</textarea>
                </div>


                <div class="loadingImg_Mobile" style="display:none;"><img src="/site/imagens/loader2.gif" alt=""></div>

                <div class="button-field btn-enviar-mobile" style="display:block;">
                  <button type="button" data-form="#form-contato-proposta" class="button-form" onclick="EnviarContatoConstrutora();"><i class="fa fa-send"></i> Enviar para Construtora</button>
                </div>

                <input type="hidden" placeholder="" name="empreendimento_id" value="{{ $empreendimento->id }}">
              </form>
        </div>
    </div>
    </div>
</div>
