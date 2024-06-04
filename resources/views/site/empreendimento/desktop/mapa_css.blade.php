<style>
    /*
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
*/
/* 
    Author     : WCOSTA
*/

body {
    padding: 0px;
    margin: 0px;
    background-color: #FFF;
}

.carregando {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-image: url(../imagem/carregando.gif);
    background-repeat: no-repeat;
    background-position: center center;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 4;
}

.controle_mapa {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 120px;
    height: 135px;
    z-index: 3;
}

.info_ajuda {
    position: fixed;
    top: 30px;
    right: 30px;
    width: 48px;
    height: 48px;
    z-index: 4;
}

.ponto_unidade {
    position: absolute;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    z-index: 2;
}

/* alterar o tamanho dos icones, mudar no php tmb */
.ponto_unidade_tam_pq {
    width: 20px;
    height: 20px;
    line-height: 20px;
    font-size: 9px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 20px;
    border: 1px solid #fff;
}

.ponto_unidade_tam_md {
    width: 40px;
    height: 40px;
    line-height: 40px;
    font-size: 11px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 40px;
    border: 2px solid #fff;
}

.ponto_unidade_tam_gd {
    width: 60px;
    height: 60px;
    line-height: 60px;
    font-size: 13px;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    border-radius: 60px;
    border: 2px solid #fff;
}

.ponto_unidade_sit_d { background-color: #009900; color: #fff; }
.ponto_unidade_sit_r { background-color: #ffcc00; color: #000; }
.ponto_unidade_sit_v { background-color: #ff0000; color: #fff; }
.ponto_unidade_sit_o { background-color: #467eb6; color: #fff; }
.ponto_unidade_sit_b { background-color: #467eb6; color: #fff; }
.ponto_unidade_sit_s { background-color: #2D00B2; color: #fff; }

.ponto_unidade_pne_S_pq{background-image: url(../imagem/pne20.png);}
.ponto_unidade_pne_S_md{background-image: url(../imagem/pne40.png);}
.ponto_unidade_pne_S_gd{background-image: url(../imagem/pne60.png);}

.ponto_unidade_pne_N { background-color: transparent; }

.ponto_foto {
    position: absolute;
    width: 45px;
    height: 46px;
    cursor: pointer;
    z-index: 2;    
}

#tela {    
    z-index: 1;
    position: absolute;
    top: 0;
    padding-bottom: 150px !important;
}

/* inicio - excluir modal */

.modal-header-situacao-d {
    background-color: #009900;
    color: #fff;
}
.modal-header-situacao-r {
    background-color: #ffcc00;
}
.modal-header-situacao-v {
    background-color: #ff0000;
    color: #fff;
}
.modal-header-situacao-p {
    background-color: #cc4d50;
    color: #fff;
}
.modal-header-situacao-o {
    background-color: #467eb6;
    color: #fff;
}



#modal_detalhes .modal-header .close {
    color: #FFF;	
}

#modal_detalhes .modal-body {
    background-color: #dae4ef;
}

#modal_detalhes .modal-footer {
    background-color: #dae4ef;
}

.sem_margin_bottom {
    margin-bottom: 0px;
}

.modal-dialog{
   width: 472px;
}

/* fim - excluir modal */

/* unidade */

.box_detalhes_unidade{
    margin: 0px;
}

.box_detalhes_unidade #dados-unidade-reserva{
    width: 100%;
    height: auto;
}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote{
    width: 100%;
    height: auto;
}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote{
    width: 100%;
    height: 50px;
}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .quadra{width: 30%; height: 80px; text-align: center; float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .quadra .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 14px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .quadra .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 20px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .lote{width: 30%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .lote .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 14px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .lote .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 20px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .terreno{width: 40%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .terreno .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 14px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-lote .terreno .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 20px; font-size: 20px; color: #333;padding: 10px;}


.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .planta{width: 100%; height: 30px; text-align: center; float: left; line-height: 30px; background-color: #00B2B2; color: #FFF; font-size: 20px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .area_privativa{width: 31%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .area_privativa .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 16px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .area_privativa .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 20px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .quartos{width: 23%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .quartos .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 16px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .quartos .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 15px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .suites{width: 23%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .suites .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 16px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .suites .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 15px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .garagem{width: 23%; height: 80px; text-align: center;float: left;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .garagem .titulo{width: 100%; height: auto; text-align: center; float: left; line-height: 20px; font-size: 16px; color: #00B2B2; padding: 10px; background-color: #F5F5F5;}
.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .dados-planta .garagem .valor{width: 100%; height: 20px; text-align: center; float: left; line-height: 15px; font-size: 20px; color: #333;padding: 10px;}

.box_detalhes_unidade #dados-unidade-reserva .valor-unidade{width: 100%; height: 70px; font-size: 25px; float: left; margin-top: 30px;}
.box_detalhes_unidade #dados-unidade-reserva .valor-unidade .icone{width: 30%; height: 70px; text-align: center; padding: 10px; background-color: #F5F5F5; color: #FFF; float: left;}
.box_detalhes_unidade #dados-unidade-reserva .valor-unidade .valor{width: 70%; height: 70px; line-height: 20px; text-align: center; padding: 0px;  background-color: #DDFFFC;  float: left;}
.box_detalhes_unidade #dados-unidade-reserva .valor-unidade .valor .info-valor{font-size: 14px !important; text-align: center; padding: 5px; color: #AAA;}
.box_detalhes_unidade #dados-unidade-reserva .valor-unidade .valor .valor-item{font-size: 30px !important; text-align: center; padding: 0px; color: #00B2B2; font-weight: bold;}

.box_detalhes_unidade #dados-unidade-reserva .unidade-lote .info{width: 100%; height: 20px; margin-top: 20px; text-align: center; float: left; color: #00B2B2; font-size: 11px; line-height: 20px;}

.box_detalhes_unidade .solicitar-reserva{width: 100%; height: 50px; line-height: 50px; text-align: center; font-size: 16px; background-color: #00B2B2; float: left;}

.box_detalhes_unidade .solicitar-reserva{width: 390px; height: 40px; border: 1px solid #EEEEEE; background-color: #EEEEEE; background-image: url(/imagem/geral/btn-negociar-unidade.png); background-repeat: no-repeat; float: left; margin: 10px 0 0px 10px;}
.box_detalhes_unidade .solicitar-reserva:hover{cursor: pointer;}

.box_detalhes_unidade .formulario-reserva{width: 410px; height: auto; float: left; padding: 10px;}

.box_detalhes_unidade .formulario-reserva .texto-reserva{width: 390px; height: 80px; line-height: 20px; text-align: center; font-size: 14px; color: #333; float: left;}

.box_detalhes_unidade .formulario-reserva .texto-tempo-analise{width: 390px; height: 20px; line-height: 20px; text-align: center; font-size: 16px; color: #333; float: left; margin-bottom: 10px;}
.box_detalhes_unidade .formulario-reserva .texto-tempo-analise .tempo-analise{font-size: 20px; color: #BB3434 !important;}

.box_detalhes_unidade .formulario-reserva .campo-nome{width: 220px; height: 40px; float: left; margin:0 10px 10px 0; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .campo-cpf{width: 160px; height: 40px; float: left; margin:0 0px 10px 0; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .campo-estado-civil{width: 190px; height: 40px; float: left; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .campo-telefone{width: 190px; height: 40px; float: left; margin-left: 10px; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .campo-nome-conjuge{width: 220px; height: 40px; float: left; margin:10px 10px 0px 0; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .campo-cpf-conjuge{width: 160px; height: 40px; float: left; margin-top: 10px; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }
.box_detalhes_unidade .formulario-reserva .botao-reservar{width: 390px; height: 50px; float: left; background-color: #03A9F4; border: 1px solid #BFEFFF; color: #FFF; font-size: 14px; font-weight: bold; }

.box_detalhes_unidade .formulario-reserva .texto-documento-reserva{width: 390px; height: 40px; background-color: #BFEFFF; margin: 10px 0 10px 0; line-height: 20px; text-align: center; font-size: 12px; font-weight: bold; color: #00698C; float: left;}

.box_detalhes_unidade .formulario-reserva .campo-arquivo{width: 390px; height: 40px; float: left; padding: 7px; border-radius: 5px; margin-bottom: 10px; background-color: #FFF; border: 1px solid #BFEFFF; color: #333; font-size: 14px; }

#send, .loading {
    margin: 10px auto;
    width: 40%;
}

.loading > img {
    max-width: 100px
}

.loading {
    visibility: hidden
}

.fancybox-custom .fancybox-skin {
    box-shadow: 0 0 50px #222;
}

.zoom_mapa{
    width: 150px;
    height: 100px;
    background-color: #336699;
    position: absolute;
    z-index: 9999;
    bottom: 30px;
    left: 30px;
}

@media screen and (min-width: 768px) {

    .btn-gerar-pdf {
        width: 65px;
        height: 66px;
        background-image: url(/site/mapa/imagem/btn-gerar-pdf.png);
        background-repeat: no-repeat;
        position: fixed;
        right: 530px;
        top: 10px;
        z-index: 99;
        border: 0px;
    }

    .btn-compartilhar-mapa{
        width: 360px;
        height: 66px;
        position: fixed;
        background-image: url(/site/mapa/imagem/fundo-compartilhar-mapa.png);
        background-repeat: no-repeat;
        right: 160px;
        top: 10px;
        z-index: 99;
        padding: 5px;
    }

    .btn-compartilhar-mapa .titulo-input{width: 290px; height: 15px; float: left; line-height: 15px; color: #333333; text-align: left;}
    .btn-compartilhar-mapa .input-link{width: 290px; height: 35px; float: left; border: 0px; margin-top: 3px;}
    .btn-compartilhar-mapa .btn-copiar{width: 60px; height: 60px; float: right;
        background-image: url(/site/mapa/imagem/btn-copiar-mapa.png);
        background-repeat: no-repeat;
        margin-top: -15px;
    }

    .btn-compartilhar-mapa .btn-copiar:hover{
        cursor: pointer;
    }

    .btn-fechar-mapa{
        width: 180px;
        height: 59px;
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-image: url(/site/mapa/imagem/btn-fechar-mapa.png);
        background-repeat: no-repeat;
        z-index: 99;
    }

}

@media screen and (max-width: 767px) {
    .btn-compartilhar-mapa{
        display: none !important;
        background-image: none;
    }

    .btn-fechar-mapa{
        display: none !important;
    }
}


.fechar-modal{
    color: #FFF !important;
    position: absolute;
    right: 10px;
    font-size: 45px !important;
    top: -1px;
}

h4.modal-title{
    position: absolute;
    left: 15px;
    font-size: 18px;
}

#acoes-mapa-rodape {
    height: 60px;
    position: fixed;
    bottom: 0;
    background-color: #000;
    width: 100%;
    z-index: 99999999999;
    line-height: 60px;
    text-align: center;
    font-size: 20px;
    color: #FFF;
}

.topo-mapa{
    width: 100%;
    height: 100px;
    background-color: #000;
    position: absolute;
    position: fixed;
}

</style>