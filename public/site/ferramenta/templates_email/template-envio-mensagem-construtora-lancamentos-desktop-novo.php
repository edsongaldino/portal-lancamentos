<?php
$template_email = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
<head>
<title>E-mail Marketing Domus</title>
<style type="text/css">
div, p, a, li, td {
	-webkit-text-size-adjust:none;
}
.ReadMsgBody {
	width: 100%;
	background-color: #d1d1d1;
}
.ExternalClass {
	width: 100%;
	background-color: #d1d1d1;
	line-height:100%;
}
body {
	width: 100%;
	height: 100%;
	background-color: #d1d1d1;
	margin:0;
	padding:0;
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust:100%;
}
html {
	width: 100%;
}
img {
	-ms-interpolation-mode:bicubic;
}
table[class=full] {
	padding:0 !important;
	border:none !important;
}
table td img[class=imgresponsive] {
	width:100% !important;
	height:auto !important;
	display:block !important;
}
@media only screen and (max-width: 800px) {
body {
 width:auto!important;
}
table[class=full] {
 width:100%!important;
}
table[class=devicewidth] {
 width:100% !important;
 padding-left:20px !important;
 padding-right: 20px!important;
}
table td img.responsiveimg {
 width:100% !important;
 height:auto !important;
 display:block !important;
}
}
@media only screen and (max-width: 640px) {
table[class=devicewidth] {
 width:100% !important;
}
table[class=inner] {
 width:100%!important;
 text-align: center!important;
 clear: both;
}
table td a[class=top-button] {
 width:160px !important;
  font-size:14px !important;
 line-height:60px !important;
}
table td[class=readmore-button] {
 text-align:center !important;
}
table td[class=readmore-button] a {
 float:none !important;
 display:inline-block !important;
}
.hide {
 display:none !important;
}
table td[class=smallfont] {
 border:none !important;
 font-size:26px !important;
}
table td[class=sidespace] {
 width:10px !important;
}
}
 @media only screen and (max-width: 520px) {
}
@media only screen and (max-width: 480px) {

 table {
 border-collapse: collapse;
}
table td[class=template-img] img {
 width:100% !important;
 display:block !important;
}
}
@media only screen and (max-width: 320px) {
}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
  <tr>
    <td height="54">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:5px 5px 0 0; background-color:#00A3D9;">
              <tr>
                <td height="29">&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="0" align="left" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td width="23" class="hide">&nbsp;</td>
                      <td height="75" class="inner" valign="middle"><a href="#"><img class="logo" src="https://www.lancamentosonline.com.br/ferramentas/templates_email/img/logo_lancamentos.png" width="190" height="52" alt="Logo"></a></td>
                    </tr>
                  </table>
                  <table width="280" border="0" cellspacing="0" cellpadding="0" align="right" class="inner" style="border-collapse:collapse; margin-top:7px; height:60px; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td align="center" style="background: #00BFFF; font: bold 20px/50px Arial, Helvetica, sans-serif !important;  height: 60px !important; line-height: 60px !important; color: #ffffff;"><a class="top-button" style="font: bold 20px/50px Arial, Helvetica, sans-serif !important; line-height: 60px !important; color: #ffffff; height: 60px !important; text-decoration: none; display: block; text-transform: uppercase;">NOVO LEAD</a></td>
                      <td class="hide" width="20">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #dbdbdb;">&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF" style="border-bottom:1px solid #dbdbdb;">&nbsp;</td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF" style="border-bottom:1px solid #dbdbdb;"><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="background-color:#ffffff;">
                  <tr>
                    <td height="19">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width="23" class="sidespace">&nbsp;</td>
                        <td width="594"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="inner" id="banner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                          <tr>
                            <td align="center"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/img/icone-user.png" alt="" width="60" height="60"></td>
                          </tr>
                          <tr>
                            <td align="center" class="smallfont" style="font:600 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">'.$resultado_consulta["nome_cliente"].'</td>
                          </tr>
                          <tr>
                            <td height="19" align="center"><span class="smallfont" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#666;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 16px">'.$resultado_consulta["descricao_cliente_telefone"].'</span></td>
                          </tr>
                          <tr>
                            <td height="19" align="center"><span class="smallfont" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#555;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 16px">'.$resultado_consulta["descricao_cliente_email"].'</span></td>
                          </tr>
                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="68" align="center"><img src="https://www.lancamentosonline.com.br/ferramentas/templates_email/img/tipo_empreendimento_'.$resultado_consulta["codigo_tipo_empreendimento"].'.png" alt="" width="60" height="60"></td>
                          </tr>
                          <tr>
                            <td height="20" align="center"><span style="font:bold 16px Arial, Helvetica, sans-serif; color:#999;  text-transform:uppercase; font-family: Arial, Helvetica, sans-serif; font-size: 16px">'.$resultado_consulta["nome_empreendimento"].'</span></td>
                          </tr>
                          <!--
                          <tr>
                            <td height="10" align="center"><img src="https://www.lancamentosonline.com.br/imagens/empreendimento/149/original/20170110_011011_564890.jpg" width="100%"></td>
                          </tr>
                          -->
                        </table></td>
                        <td width="10" class="sidespace">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td style="border-bottom:1px solid #dbdbdb;"><table width="100%" bgcolor="#00B2B2" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(https://sistema.domuslog.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
                      <tr>
                        <td width="639" height="23" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="639" align="center"><img src="https://www.lancamentosonline.com.br/ferramentas/templates_email/images/mensagem.png" width="83" height="83" alt="picture" /></td>
                      </tr>
                      <tr>
                        <td height="23">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="50" align="center" style="width:100px !important; font:18px Arial, Helvetica, sans-serif; color:#FFFFFF; height:50px !important; background: #16c4a9;  text-transform:uppercase; line-height:50px;"><span class="readmore-button">'.$resultado_consulta["descricao_atendimento_solicitacao"].'</span></td>
                      </tr>
                      <tr>
                        <td height="23" style="font:18px Arial, Helvetica, sans-serif; color:#FFFFFF; text-align:center; height:50px !important; line-height:50px">'.converte_data_portugues($resultado_consulta["data_atendimento_log"]).' - '.$resultado_consulta["hora_atendimento_log"].'</td>
                      </tr>
                      <tr>
                        <td height="84" align="center" class="smallfont" style="font:16px Arial, Helvetica, sans-serif; font-style:italic; color:#FFFFFF; padding:0 15px 0 15px;"><p>'.$resultado_consulta["descricao_atendimento"].'</p></td>
                      </tr>
                      <tr>
                        <td height="16" colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="3">&nbsp;</td>
                      </tr>
                      <tr>
                        <td height="16" colspan="3" bgcolor="#FFFFFF"></td>
                      </tr>
                      <tr>
                        <td height="16" colspan="3" bgcolor="#FFFFFF"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#00B2B2" class="full" style=" background-image:url(https://sistema.domuslog.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
  <tr>
    <td height="16" colspan="3" align="center" bgcolor="#FFFFFF"><p><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/logo-qualificacao.png" width="60" height="60" /></p></td>
  </tr>
  <tr>
    <td height="16" colspan="3" align="center" bgcolor="#FFFFFF" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Qualificação do Lead</td>
  </tr>
  <tr>
    <td height="16" colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td width="124" height="16" align="center" bgcolor="#EEEEEE"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_renda.png" width="50" height="50" /></td>
    <td width="189" align="center" bgcolor="#EEEEEE" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Renda</td>
    <td width="287" align="center" bgcolor="#EEEEEE" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["renda"].'</td>
  </tr>
  <tr>
    <td height="16" align="center" bgcolor="#FFFFFF"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_chave.png" alt="" width="50" height="50" /></td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Previsão de compra</td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["previsao_compra"].'</td>
  </tr>
  <tr>
    <td height="16" align="center" bgcolor="#EEEEEE"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_itens.png" alt="" width="50" height="50" /></td>
    <td align="center" bgcolor="#EEEEEE" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">O que mais gostou?</td>
    <td align="center" bgcolor="#EEEEEE" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["interesse"].'</td>
  </tr>
  <tr>
    <td height="16" align="center" bgcolor="#FFFFFF"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_tempo.png" alt="" width="50" height="50" /></td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Tempo no site</td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["tempo_site"].'</td>
  </tr>
  <tr>
    <td height="16" align="center" bgcolor="#EEEEEE"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_origem.png" alt="" width="50" height="50" /></td>
    <td align="center" bgcolor="#EEEEEE" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Origem</td>
    <td align="center" bgcolor="#EEEEEE" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["origem"].'</td>
  </tr>
  <tr>
    <td height="16" align="center" bgcolor="#FFFFFF"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icone_dispositivo.png" alt="" width="50" height="50" /></td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Dispositivo</td>
    <td align="center" bgcolor="#FFFFFF" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#FC0;">'.$resultado_consulta["dispositivo"].'</td>
  </tr>
  <tr>
    <td height="16" colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    <td height="16" colspan="3" bgcolor="#FFFFFF"></td>
  </tr>
</table></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td bgcolor="#FFFFFF" style="border-bottom:1px solid #dbdbdb;"><table width="100%" bgcolor="#00A3D9" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(https://sistema.domuslog.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
                  <tr>
                    <td height="23">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><img src="https://www.lancamentosonline.com.br/imagens/construtora/83x83/construtora_'.$resultado_consulta["codigo_construtora"].'.png" width="83" height="83" alt="picture" /></td>
                  </tr>
                  <tr>
                    <td height="23" style="font:16px Arial, Helvetica, sans-serif; text-align:center; color:#FFFFFF; padding:10px 15px 10px 15px;">www.lancamentosonline.com.br</td>
                  </tr>
                  <tr>
                    <td height="16">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width="40%" height="2"></td>
                        <td width="10%" height="2" style=" border-bottom:2px solid #ffffff;"></td>
                        <td width="40%" height="2"></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="16"></td>
                  </tr>
                  <tr>
                    <td height="16" bgcolor="#FFFFFF"></td>
                  </tr>
                  <tr>
                    <td height="16" bgcolor="#FFFFFF"><table width="639" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
                      <tr>
                        <td width="639"><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:0 0 7px 7px; color:#999; font:14px Arial, Helvetica, sans-serif;">
                          <tr>
                            <td height="18">&nbsp;</td>
                          </tr>
                          <tr>
                            <td><table class="inner" align="left" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                              <tr>
                                <td width="21" height="65">&nbsp;</td>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#AAA;">Este e-mail foi enviado para:</td>
                                  </tr>
                                  <tr>
                                    <td height="18" align="center" style="font:12px Helvetica,  Arial, sans-serif; color:#AAA;"><p>'.$destino.'</p>
                                      <p>&nbsp;</p></td>
                                  </tr>
                                </table></td>
                                <td width="21">&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="20">&nbsp;</td>
                      </tr>
                      <tr style="background-color: #FFFFFF;">
                        <td height="20" align="center" style="background-color: #FFFFFF;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/img/icone-desktop.png" alt="" width="50" height="50" /></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="16" bgcolor="#FFFFFF"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td width="639">&nbsp;</td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>';
?>