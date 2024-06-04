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

.ponto_garagem {
    position: absolute;
    text-align: center;
    font-weight: bold;
    cursor: pointer;
    z-index: 2;
}

/* alterar o tamanho dos icones, mudar no php tmb */
.ponto_garagem_tam_pq {
    width: 25px;
    height: 25px;
    line-height: 25px;
    font-size: 9px;
    -webkit-border-radius: 20px;
    -moz-border-radius: 20px;
    border-radius: 0px;
    border: 1px solid #fff;
}

.ponto_garagem_tam_md {
    width: 40px;
    height: 40px;
    line-height: 37px;
    font-size: 11px;
    -webkit-border-radius: 40px;
    -moz-border-radius: 40px;
    border-radius: 0px;
    border: 2px solid #fff;
}

.ponto_garagem_tam_gd {
    width: 60px;
    height: 60px;
    line-height: 57px;
    font-size: 13px;
    -webkit-border-radius: 60px;
    -moz-border-radius: 60px;
    border-radius: 0px;
    border: 2px solid #fff;
}

.ponto_garagem_sit_d { background-color: #009900; color: #fff; }
.ponto_garagem_sit_r { background-color: #ffcc00; color: #000; }
.ponto_garagem_sit_v { background-color: #ff0000; color: #fff; }
.ponto_garagem_sit_o { background-color: #467eb6; color: #fff; }
.ponto_garagem_sit_b { background-color: #467eb6; color: #fff; }
.ponto_garagem_sit_s { background-color: #2D00B2; color: #fff; }

.ponto_garagem_pne_S_pq{background-color: #0d0131; color: #fff;}
.ponto_garagem_pne_S_md{background-color: #0d0131; color: #fff;}
.ponto_garagem_pne_S_gd{background-color: #0d0131; color: #fff;}

.formato_vaga_padrao{}
.formato_vaga_extra{}
.formato_vaga_visitante{background-color: #e06b0b !important; color: #fff;}

.ponto_garagem_pne_N { background-color: transparent; }

.gaveta-descoberta-pq{line-height: 12px !important;}
.gaveta-coberta-pq{line-height: 12px !important;}

.gaveta-descoberta-md{line-height: 17px !important;}
.gaveta-coberta-md{line-height: 17px !important;}

.gaveta-descoberta-gd{line-height: 27px !important;}
.gaveta-coberta-gd{line-height: 27px !important;}

.padrao-pq{};
.padrao-md{};
.padrao-gd{};

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

/* garagem */

.box_detalhes_garagem{
    margin: 0px;
}

.box_detalhes_garagem .info{
    text-align: center !important;
    width: 100%;
    float: left;
    margin-top: 20px;
}

.box_detalhes_garagem .topo-garagem{
    width: 100%;
    height: 50px;
    background-color: #333333;
}

.box_detalhes_garagem .dados-unidade{
    margin: 0px;
}

.box_detalhes_garagem .topo{
    width: 100%;
    height: 30px;
    line-height: 30px;
    text-align: center;
    color: #e4e4e4;
    background-color: #2b3b4c;
    font-size: 16px;
    float: left;
}

.box_detalhes_garagem .descricao-unidade{
    width: 100%;
    height: 50px;
}

.box_detalhes_garagem .descricao-unidade .icone{
    width: 10%;
    height: 50px;
    font-size: 30px;
    line-height: 50px;
    background-color: #dae4ef;
    color: #333333;
    text-align: center;
    float: left;

}

.box_detalhes_garagem .descricao-unidade .nome{
    width: 80%;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    background-color: #FFF;
    color: #2c2e2e;
    text-align: left;
    padding-left: 10px;
    float: left;

}

.box_detalhes_garagem .descricao-unidade .valor{
    width: 40px;
    height: 40px;
    margin-top: 5px;
    font-size: 20px;
    line-height: 40px;
    background-color: #009aa5;
    color: #FFF;
    text-align: center;
    float: right;
    border-radius: 50%;

}

.box_detalhes_garagem .dados-vaga{
    margin: 10px 0px 0px 0px;
}

.box_detalhes_garagem .descricao-vaga{
    width: 50%;
    height: 50px;
    float: left;
}

.box_detalhes_garagem .descricao-vaga .icone{
    width: 20%;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    background-color: #dae4ef;
    color: #5c6c6f;
    text-align: center;
    float: left;
}

.box_detalhes_garagem .descricao-vaga .nome{
    width: 80%;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    background-color: #FFF;
    color: #2c2e2e;
    text-align: left;
    padding-left: 10px;
    float: left;

}

@media screen and (max-width: 768px) {

.box_detalhes_garagem .descricao-vaga .nome{
    line-height: 20px;
    padding-top: 5px;
}

.box_detalhes_garagem .descricao-unidade .nome{
    line-height: 20px;
    padding-top: 5px;
}

}


.box_detalhes_garagem .vaga-pne{
    width: 50%;
    height: 50px;
    float: left;
}

.box_detalhes_garagem .vaga-pne .icone{
    width: 20%;
    height: 40px;
    margin-top: 5px;
    font-size: 20px;
    line-height: 40px;
    background-color: #08010f;
    color: #FFF;
    text-align: center;
    float: left;
    text-transform: uppercase;
}

.box_detalhes_garagem .vaga-pne .nome{
    width: 80%;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    background-color: rgb(255, 255, 255);
    color: #08010f;
    text-align: left;
    padding-left: 10px;
    float: left;
    

}

.box_detalhes_garagem .formato-vaga{
    width: 50%;
    height: 50px;
    float: left;
}

.box_detalhes_garagem .formato-vaga .icone{
    width: 20%;
    height: 40px;
    margin-top: 5px;
    font-size: 20px;
    line-height: 40px;
    background-color: #009aa5;
    color: #FFF;
    text-align: center;
    float: left;
    text-transform: uppercase;
}

.box_detalhes_garagem .formato-vaga .nome-formato{
    width: 80%;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    background-color: rgb(255, 255, 255);
    color: #048888;
    text-align: left;
    padding-left: 10px;
    float: left;
    

}

.box_detalhes_garagem .dados-vaga .formato-vaga.padrao .icone{background-color: rgb(4, 121, 189);color: #ffffff;}
.box_detalhes_garagem .dados-vaga .formato-vaga.extra .icone{background-color: rgb(6, 160, 114);color: #ffffff;}
.box_detalhes_garagem .dados-vaga .formato-vaga.visitante .icone{background-color: rgb(216, 178, 11);color: #ffffff;}
.box_detalhes_garagem .dados-vaga .formato-vaga.visitante .nome-formato{color: rgb(216, 178, 11);}

.box_detalhes_garagem .valor-vaga{
    width: 50%;
    height: 50px;
    float: left;
}

.box_detalhes_garagem .valor-vaga .icone{
    width: 20%;
    height: 40px;
    margin-top: 5px;
    font-size: 20px;
    line-height: 40px;
    background-color: #009aa5;
    color: #FFF;
    text-align: center;
    float: left;
}

.box_detalhes_garagem .valor-vaga .valor{
    width: 80%;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    background-color: rgb(255, 255, 255);
    color: #048888;
    text-align: left;
    padding-left: 10px;
    float: left;
    

}

.box_detalhes_garagem .tipo-vaga{
    width: 50%;
    height: 50px;
    float: left;
}

.box_detalhes_garagem .tipo-vaga .icone{
    width: 20%;
    height: 40px;
    margin-top: 5px;
    font-size: 20px;
    line-height: 40px;
    background-color: #009aa5;
    color: #FFF;
    text-align: center;
    float: left;
}

.box_detalhes_garagem .tipo-vaga .nome-tipo{
    width: 80%;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    background-color: rgb(255, 255, 255);
    color: #222b2b;
    text-align: left;
    padding-left: 10px;
    float: left;
    

}

@media screen and (max-width: 768px) {
    .box_detalhes_garagem .tipo-vaga .nome-tipo.gaveta{
        line-height: 20px;
        padding-top: 5px;
    }

    .box_detalhes_garagem .tipo-vaga.individual-coberta .nome-tipo{
        line-height: 20px;
        padding-top: 5px;
    }
}

.box_detalhes_garagem .dados-vaga .tipo-vaga .icone.gaveta{
    line-height: 17px !important;
    padding-top: 2px;
    font-size: 14px;
}


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