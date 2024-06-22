<?php
$template_email .= '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,700,600" rel="stylesheet" type="text/css">
<head>
<title>Relatório Lançamentos Online</title>
<style type="text/css">
div, p, a, li, td {
	-webkit-text-size-adjust:none;
}
.ReadMsgBody {
	width: 100%;
}
.ExternalClass {
	width: 100%;
	background-color: #d1d1d1;
	line-height:100%;
}
body {
	width: 100%;
	height: 100%;
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
 line-height:37px !important;
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

.logo-construtora{
	border-radius:50% !important;
}
</style>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
  <tr>
    <td align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="devicewidth">
        <tr>
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:5px 5px 0 0; background-color:#ffffff;">
              <tr>
                <td height="19" bgcolor="#F1F1F1" align="center">&nbsp;</td>
              </tr>
              <tr>
                <td height="29">&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="0" align="left" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td width="23" class="hide">&nbsp;</td>
                      <td width="275" height="75" valign="middle" class="inner"><a href="#"><img class="logo" src="https://www.lancamentosonline.com.br/ferramenta/templates_email/img/logo_lancamentos_cor.png" width="190" alt="Logo"></a></td>
                    </tr>
                  </table>
                  <table width="230" border="0" cellspacing="0" cellpadding="0" align="right" class="inner" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    <tr>
                      <td height="15">&nbsp;</td>
                    </tr>
                    <tr>
                      <td align="center"><a href="#" class="top-button" style="font:bold 13px/37px Arial, Helvetica, sans-serif; color:#ffffff; text-decoration:none; background:#16c4a9; display:block; border-radius:24px; text-transform:uppercase;">De '.converte_data_portugues($inicio_relatorio).' à '.date('d/m/Y').'</a></td>
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
          <td><table width="100%" bgcolor="#f1f1f1" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
              <tr>
                <td height="35">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="full">
                    <tr>
                      <td width="23" class="sidespace">&nbsp;</td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td align="center" class="logo-construtora"><img src="'.$logo_construtora.'" width="120" height="120" alt="picture" class="logo-construtora" /></td>
                          </tr>
                          <tr>
                            <td height="6"></td>
                          </tr>
                          <tr>
                            <td align="center" style="font:700 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;" class="smallfont">'.$envio_relatorio['nome_construtora'].'</td>
                          </tr>
                          <tr>
                            <td height="33">&nbsp;</td>
                          </tr>
                          <tr>
                            <td bgcolor="#ffffff"><p>&nbsp;</p>
                              <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
                              <tr>
                                <th height="92" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_monitor-graphs_532632.png" width="80"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:18px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><p>Olá <span style="font:25px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">'.$envio_relatorio['nome_contato_construtora'].'</span>, acompanhe o relatório de  acesso dos seus produtos nos últimos 15 dias.</p></td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              
                              
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_Internet_Line-02_1587499.png" alt="" width="60"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#2175AA;">+ '.$total_visualizacoes_geral.'</span> pessoas navegaram no portal</td>
                              </tr>
                              
                              <tr>
                                <td align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                                <td align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="50%" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_computer_2130493.png" alt="" width="60"></td>
                                <td width="50%" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><p><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_18_2135922.png" alt="" width="50"></p></td>
                              </tr>
                              <tr>
                                <td align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#EF5F27;">'.round($percentual_desktop).'%</span><br/>Desktop</td>
                                <td align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#80CBC4;">'.round($percentual_mobile).'%</span><br/>Mobile</td>
                              </tr>
                              
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_building-o_1608589 (1).png" alt="" width="60"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#77B3D4;">'.$total_produtos.'</span> produtos publicados pela <span style="font:700 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">'.$envio_relatorio['nome_abreviado'].'</span></td>
                              </tr>
                              
                              
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_eye_115733.png" alt="" width="60"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#77B3D4;">+ '.$total_visualizacoes.'</span> visualizações dos seus produtos</td>
                              </tr>
                              
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_Science__Technology_23_2633196.png" alt="" width="60"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#80CBC4;">+ '.$total_cliques.'</span> se interessaram e clicaram nos seus produtos</td>
                              </tr>
                              ';
                              if($total_leads>0):
                              $template_email .=
                              '<tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_Jee-61_2180756.png" alt="" width="80"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#EF5F27;">+ '.$total_leads.'</span> leads/contatos foram recebidos</td>
                              </tr>
                              ';
                              endif;
                              $template_email .= 
                              '
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_16_4157086.png" alt="" width="90"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#00B285;">'.$total_ofertas.'</span> Ofertas publicadas</td>
                              </tr>

                              ';
                              if($total_propostas>0):
                              $template_email .=
                              '<tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <th height="68" colspan="2" scope="col"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_circle-edit-article_1495216.png" alt="" width="80"></th>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#00B285;">'.$total_propostas.'</span> propostas recebidas</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                              ';
                              endif;
                              $template_email .= 
                              '
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/iconfinder_Happy_3713806.png" alt="" width="128"></td>
                              </tr>
                              <tr>
                                <td colspan="2" align="center" class="smallfont" style="font:16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><p>Mantenha os produtos sempre atualizados; preços, previsão de  entrega e <span style="font:700 25px Open Sans, Arial, Helvetica, sans-serif; color:#00B285;">oferta online</span></p></td>
                              </tr>
                              </table>
                            <p>&nbsp;</p></td>
                          </tr>
                          <tr>
                            <td height="32"></td>
                          </tr>
                        </table></td>
                      <td width="23" class="sidespace">&nbsp;</td>
                    </tr>
                  </table></td>
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
          <td><table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style="border-radius:0 0 7px 7px;">
              <tr>
                <td height="18">&nbsp;</td>
              </tr>
              <tr>
                <td><table class="inner" align="right" width="340" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                    <tr>
                      <td width="21">&nbsp;</td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
                                <tr>
                                  <!--
                                  <td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;"><a style="color:#000000; text-decoration:none;" href="#"> Ver no browser</a></td>
                                  <td style="color:#000000;"> | </td>
                                  <td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;"><a style="color:#000000; text-decoration:none;" href="#"> Sair</a></td>
                                  <td style="color:#000000;"> | </td>
                                  <td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;"><a style="color:#000000; text-decoration:none;" href="#"> Encaminhar</a></td>
                                  <td class="hide" width="40" align="right">&nbsp;</td>-->
                                </tr>
                                <tr>
                                  <td height="18">&nbsp;</td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                  </table>
                  <table class="inner" align="left" width="230" border="0" cellspacing="0" cellpadding="0" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                    <tr>
                      <td width="21">&nbsp;</td>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td align="center" style="font:11px Helvetica,  Arial, sans-serif; color:#000000;">&copy; 2019 Portal Lançamentos Online</td>
                          </tr>
                          <tr>
                            <td height="18">&nbsp;</td>
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
</html>'
;
?>