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
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:5px 5px 0 0; background-color:#0085B2;">
              <tr>
                <td height="29">&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="0" align="left" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td width="23" class="hide">&nbsp;</td>
                      <td height="75" class="inner" valign="middle"><a href="#"><img class="logo" src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/logo_branca.png" width="150" height="100" alt="Logo"></a></td>
                    </tr>
                  </table>
                  <table width="280" border="0" cellspacing="0" cellpadding="0" align="right" class="inner" style="border-collapse:collapse; height:60px; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td height="15">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center" style="background: #00698C; font: bold 20px/50px Arial, Helvetica, sans-serif; line-height: 60px; color: #ffffff; height: 60px !important; text-decoration: none; display: block; text-transform: uppercase;"><a class="top-button" style="font: bold 20px/50px Arial, Helvetica, sans-serif; line-height: 60px; color: #ffffff; height: 60px !important; text-decoration: none; display: block; text-transform: uppercase;">INDICADO PRA VOC�</a></td>
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
                            <td style="font:bold 16px Arial, Helvetica, sans-serif; color:#777;" class="smallfont"><p>Ol&aacute;, '.$resultado_consulta["nome_cliente"].'</p>
                            <p><span style="color:#00698C;">'.$usuario['nome_usuario'].', </span>
                            da empresa '.$origem_envio.' lhe indicou o empreendimento abaixo.</p></td>
                          </tr>
                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                        </table></td>
                      <td width="23" class="sidespace">&nbsp;</td>
                    </tr>
                  </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                    <tr>
                      <td width="23" height="16">&nbsp;</td>
                      <td height="16" colspan="2" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                        <tr>
                          <td height="33">&nbsp;</td>
                        </tr>
                        <tr>
                          <td bgcolor="#ffffff"><table align="left" width="47%" border="0" cellspacing="0" cellpadding="0" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                            <tr>
                              <td><img class="imgresponsive" src="https://www.lancamentosonline.com.br/imagens/empreendimento/'.$id_empreendimento.'/ampliada/'.$foto_empreendimento.'" width="100%" height="285" alt="picture" /></td>
                            </tr>
                          </table>
                            <table align="left" width="53%" border="0" cellspacing="0" cellpadding="0" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                              <tr>
                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="inner">
                                  <tr>
                                    <td width="39" height="252" class="sidespace">&nbsp;</td>
                                    <td width="247">
                                      
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td style="font:bold 20px Arial, Helvetica, sans-serif; color:#333332;">'.$nomeEmpreendimento.'</td>
                                          </tr>
                                        <tr>
                                          <td height="5"></td>
                                          </tr>
                                        <tr>
                                          <td style="font:14px/19px Arial, Helvetica, sans-serif; color:#333332; text-align:justify;"><p>'.limitar_texto($descricaoEmpreendimento,200).'</p></td>
                                          </tr>
                                        
                                        <tr>
                                          <td height="95">
                                            
                                            <table width="100%" cellspacing="0" cellpadding="0" align="right" style="border:0px dashed #339966;">
                                              <tr>
                                                <td align="center" width="30%" style="border:1px solid #DFDFDF; "><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/icone-quartos.png" width="50" height="50" alt="Social Media" /></td>
                                                <td align="center" width="30%" style="border:1px solid #DFDFDF; border-left:none; "><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/icone-suites.png" width="50" height="50" alt="Social Media" /></td>
                                                <td align="center" width="30%" style="border:1px solid #DFDFDF; border-left:none; "><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/icone_garagem.png" width="50" height="50" alt="Social Media" /></td>
                                                </tr>
                                              
                                              <tr>
                                                <td align="center" width="30%" height="40" style="border:1px solid #DFDFDF; font: bold 14px Arial, Helvetica, sans-serif; color: #16c4a9; text-align:center;">'.qtd_dormitorio_msg($id_empreendimento).'</td>
                                                <td align="center" width="30%" height="40" style="border:1px solid #DFDFDF; border-left:none; font: bold 14px Arial, Helvetica, sans-serif; color: #16c4a9; text-align:center;">'.qtd_suites_msg($id_empreendimento).'</td>
                                                <td align="center" width="30%" height="40" style="border:1px solid #DFDFDF; border-left:none; font: bold 14px Arial, Helvetica, sans-serif; color: #16c4a9; text-align:center;">'.qtd_vagas_msg($id_empreendimento).'</td>
                                                </tr>
                                              
                                              </table>
                                            
                                            </td>
                                          </tr>
                                        
                                        </table>
                                      
                                    </td>
                                    </tr>
                                  </table></td>
                              </tr>
                            </table></td>
                        </tr>

                        <tr>
                          <td align="center" style="color:#CCC">_____________________________________________________</td>
                        </tr>
                       <tr>
              <td height="50" colspan="2" align="center" style="width:100px !important; height:50px !important; background: #16c4a9; font: bold 12px/40px Arial, Helvetica, sans-serif; color: #ffffff; line-height:50px;"><span class="readmore-button"><a href="http://www.domuslog.com.br/sistema/modulo/externo/arquivos/externo_consultar_empreendimento_selecao.php?chave=' . $chave_envio . '&codigo_envio=' . $codigo_envio . '&tipo=' . $tipo . '&codigo=' . $codigo . '&email=' . $email . '&codigo_construtora=' . $codigo_construtora . '&codigo_parceiro=' . $codigo_parceiro . '" style="font: bold 12px/40px Arial, Helvetica, sans-serif; color: #ffffff; text-decoration: none; padding:10px 50px 10px 50px; line-height:50px; text-align:center; text-transform: uppercase;">VISUALIZAR EMPREENDIMENTO</a></span></td>
            </tr>
            	 <tr>
                  <td height="22" align="center"></td>
                </tr>
                <tr>
                  <td height="22" align="center" style="font:600 22px Open Sans, Arial, Helvetica, sans-serif; color:#2B7B7B;">Gostou deste empreendimento?</td>
                </tr>
                <tr>
                  <td height="22" align="center" style="font:600 18px Open Sans, Arial, Helvetica, sans-serif; color:#3DD1AF;">Fale comigo agora!</td>
                </tr>
                <tr>
                    <td height="22" align="center"></td>
                  </tr>
                  <tr>
                    <td height="22" align="center"><img src="'.$foto_usuario.'" width="100" height="auto" alt="picture" /></td>
                  </tr>
                  <tr>
                    <td align="center" style="font:600 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;" class="smallfont">'.$nome_usuario.'</td>
                  </tr>
                  <tr>
                    <td align="center" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#999;" class="smallfont"><span class="smallfont" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#999;">'.$perfil_usuario.'</span></td>
                  </tr>
                  <tr>
                    <td align="center" style="font:300 16px Open Sans, Arial, Helvetica, sans-serif; color:#999;" class="smallfont">'.$creci_usuario.'</td>
                  </tr>
                  <tr>
                    <td height="19" align="center">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="19" align="center"><table width="50%" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td align="center" width="50%"><a href="tel:'.$telefone_usuario.'"><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/icone_phone.png" width="70" height="70" alt="Social Media" /></a></td>
                        <td align="center" width="50%"><a href="mailto:'.$email_usuario.'"><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/img/icone_email.png" width="70" height="70" alt="Social Media" /></a></td>
                      </tr>
                    </table></td>
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
          <td><table width="100%" bgcolor="#00698C" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(http://sistema.domuslog.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
              <tr>
                <td height="23">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><img src="http://sistema.domuslog.com.br/ferramenta/templates_email/images/picture.png" width="83" height="atuo" alt="picture" /></td>
              </tr>
              <tr>
                <td height="23">&nbsp;</td>
              </tr>
              <tr>
                <td align="center" style="font:27px Arial, Helvetica, sans-serif; color:#FFFFFF; padding:0 15px 0 15px;" class="smallfont">A maior rede online de construtoras e incorporadoras do estado de Mato Grosso</td>
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
                      <td height="18" align="center" style="font:12px Helvetica,  Arial, sans-serif; color:#AAA;"><p>'.$email .'</p>
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
      </table></td>
  </tr>
</table>
</body>
</html>';
?>