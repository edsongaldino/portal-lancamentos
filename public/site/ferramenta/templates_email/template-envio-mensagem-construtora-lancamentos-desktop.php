<?php
include("painelcorretor/ferramenta/funcao_php/converte_data_portugues.php");
$template_email = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
<head>
<title>Lan�amentos Online</title>
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
 color:#FFF;
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
<body style="background-color: #d1d1d1;">
<table width="100%" border="0" bgcolor="#d1d1d1" cellspacing="0" cellpadding="0" align="center" class="full">
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
                      <td align="center" style="background: #00BFFF; color:#FFFFFF;"><span class="top-button" style="font: bold 20px/50px Arial, Helvetica, sans-serif; line-height: 60px; color: #ffffff; height: 60px !important; text-decoration: none; display: block; text-transform: uppercase;">NOVO CONTATO</span></td>
                      <td class="hide" width="20">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #dbdbdb;">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="background-color:#ffffff;">
              <tr>
                <td height="19">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="23" class="sidespace">&nbsp;</td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="left" class="inner" id="banner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                          <tr>
                            <td align="center">&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center" class="smallfont" style="font:600 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">'.$resultado_consulta["nome_cliente"].'</td>
                          </tr>
                          <tr>
                            <td align="center" class="smallfont" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#999;">'.$resultado_consulta["cidade_endereco"].' - '.$resultado_consulta["estado_endereco"].'</td>
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
                        </table></td>
                      <td width="23" class="sidespace">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #dbdbdb;"><table width="100%" bgcolor="#00B2B2" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(https://www.lancamentosonline.com.br/ferramentas/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
                  <tr>
                    <td height="23">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><img src="https://www.lancamentosonline.com.br/ferramentas/templates_email/images/mensagem.png" width="83" height="83" alt="picture" /></td>
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
                </table></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td><table width="100%" bgcolor="#00A3D9" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(https://www.lancamentosonline.com.br/ferramentas/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
              <tr>
                <td height="23">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><img src="https://www.lancamentosonline.com.br/imagens/construtora/83x83/construtora_'.$resultado_consulta["codigo_construtora"].'.png" width="83" height="83" alt="picture" /></td>
              </tr>
              <tr>
                <td height="23" style="font:16px Arial, Helvetica, sans-serif; text-align:center; color:#FFFFFF; padding:10px 15px 10px 15px;">www.lancamentosonline.com</td>
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
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:0 0 7px 7px; color:#999; font:14px Arial, Helvetica, sans-serif;">
              <tr>
                <td height="18">&nbsp;</td>
              </tr>
              <tr>
                <td><table class="inner" align="left" width="100%" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                    <tr>
                      <td width="21">&nbsp;</td>
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
        <tr style="background-color: #d1d1d1;">
          <td height="20" style="background-color: #d1d1d1;">'.$icone_tipo_envio.'</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';
?>