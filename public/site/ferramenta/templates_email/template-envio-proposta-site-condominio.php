<?php 
$template_email.= '<html xmlns="http://www.w3.org/1999/xhtml">
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
              <tr align="center">
                <td><a href="#"><img class="logo" src="https://www.lancamentosonline.com.br/ferramenta/templates_email/img/logo_lancamentos.png" width="190" height="52" alt="Logo"></a></td>
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
                            <td width="100%" align="center"><span style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 20px">'.$data_portugues.'</span></td>
                          </tr>
                          <tr>
                            <td align="center" class="smallfont" style="font:600 27px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Nova Proposta</td>
                          </tr>
                          <tr>
                            <td height="20">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="68" align="center"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/img/icone-empreendimento.png" alt="" width="60" height="60"></td>
                          </tr>
                          <tr>
                            <td height="20" align="center">&nbsp;</td>
                          </tr>
                          <tr>
                            <td height="20" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="5" align="left" class="inner" id="banner4" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                              <tr>
                                <td colspan="5" align="center" bgcolor="#00B2B2"><span style="font:bold 22px Arial, Helvetica, sans-serif; color:#FFF; font-family: Arial, Helvetica, sans-serif; font-size: 22px">'.$oferta["nome_empreendimento"].'</span></td>
                              </tr>
                              <tr>
                                <td colspan="5" align="center" bgcolor="#FFFFFF"><img src="https://sistema.domuslog.com.br/imagem/icone/icone_'.$oferta["sigla_tipo_sol"].'.png" title="Sol '.$oferta["tipo_sol"].'" width="120" height="60"></td>
                              </tr>
                              <tr>
                                <td width="11%" align="center" bgcolor="#FFFFFF" class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-unidade-1.png" width="30" height="30"></td>
                                <td width="19%" align="left" bgcolor="#FFFFFF" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Unidade:</td>
                                <td colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$oferta["nome_torre"].' - '.$oferta["andar"].'º Andar, Unidade '.$oferta["nomeclatura"].'</td>
                              </tr>
                              <tr>
                                <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-planta.png" alt="" width="30" height="30"></span></td>
                                <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Planta:</span></td>
                                <td width="29%" height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$oferta["nome_planta"].'</td>
                                <td width="15%" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Metragem:</span></td>
                                <td width="26%" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.converte_valor_real($oferta["area_privativa_real"]).'m²</td>
                              </tr>
                              <tr>
                                <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-quartos.png" alt="" width="30" height="30"></span></td>
                                <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Dormitórios:</span></td>
                                <td height="20" align="left" bgcolor="#FFFFFF" style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;"><span style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 16px">'.$oferta["qtd_dormitorio"].'</span></td>
                                <td height="20" bgcolor="#FFFFFF" style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Suítes:</span></td>
                                <td height="20" align="left" bgcolor="#FFFFFF" style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;"><span style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 16px">'.qtd_suites_planta($oferta["id_empreendimento_planta"],$pdo).'</span></td>
                              </tr>
                              <tr>
                                <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-money.png" alt="" width="30" height="30"></span></td>
                                <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Valor Oferta:</span></td>
                                <td height="20" colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;">R$ '.converte_valor_real($oferta["unidade_preco_desconto"]).'</td>
                              </tr>
                              <tr>
                                <td height="20" colspan="5" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                              </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      <td width="23" class="sidespace">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td style="border-bottom:1px solid #dbdbdb;"><table width="100%" bgcolor="#00B2B2" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(http://sistema.domuslog.com.br/ferramenta/templates_email/https://www.lancamentosonline.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
                  <tr>
                    <td width="182" height="23">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/usuario.png" width="83" height="83" alt="picture" /></td>
                  </tr>
                  <tr>
                    <td height="23"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width="23" class="sidespace">&nbsp;</td>
                        <td><table width="100%" border="0" cellspacing="0" cellpadding="5" align="left" class="inner" id="banner2" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                          <tr>
                            <td colspan="5" align="center" bgcolor="#00B2B2">&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="5" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                          </tr>
                          <tr>
                            <td width="11%" align="center" bgcolor="#FFFFFF" class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-user.png" width="30" height="30"></td>
                            <td width="17%" align="left" bgcolor="#FFFFFF" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Nome:</td>
                            <td colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$nome_cliente.'</td>
                          </tr>
                          <tr>
                            <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-cpf.png" alt="" width="30" height="30"></span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">CPF:</span></td>
                            <td width="31%" height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.mask($cpf_cliente,'###.###.###-##').'</td>
                            <td width="15%" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">D. Nasc:</span></td>
                            <td width="26%" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.converte_data_portugues($data_nascimento_cliente).'</td>
                          </tr>
                          <tr>
                            <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-mail.png" alt="" width="30" height="30"></span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Email:</span></td>
                            <td height="20" colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$email_cliente.'</td>
                          </tr>
                          <tr>
                            <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-phone.png" alt="" width="30" height="30"></span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Telefone:</span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.formataTelefone($telefone_cliente).'</td>
                            <td height="20" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 14px">E. Civil:</span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$estado_civil["descricao_estado_civil"].'</td>
                          </tr>';
                          if($codigo_estado_civil == 2 || $codigo_estado_civil == 6):
                          $template_email.='
                          <tr>
                            <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-user.png" alt="" width="30" height="30"></span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Nome Cônjuge:</span></td>
                            <td width="31%" height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$nome_conjuge.'</td>
                            <td width="15%" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">CPF:</span></td>
                            <td width="26%" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.mask($cpf_conjuge,'###.###.###-##').'</td>
                          </tr>';
                          endif;
                          $template_email.='
                          <tr>
                            <td height="20" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-money.png" alt="" width="30" height="30"></span></td>
                            <td height="20" align="left" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Renda:</span></td>
                            <td height="20" colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#F90;">R$ '.converte_valor_real($renda_cliente).'</td>
                          </tr>
                          <tr>
                            <td height="20" colspan="5" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                            </tr>
                        </table></td>
                        <td width="23" class="sidespace">&nbsp;</td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td height="20" align="center" class="smallfont" style="font:16px Arial, Helvetica, sans-serif; font-style:italic; color:#FFFFFF; padding:0 0px 0 0px;">&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width="40%" height="2"></td>
                        <td width="10%" height="2"></td>
                        <td width="40%" height="2"></td>
                        </tr>
                      </table></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF"><table width="100%" bgcolor="#FFCC66" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(http://sistema.domuslog.com.br/ferramenta/templates_email/https://www.lancamentosonline.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
                      <tr>
                        <td width="182" height="23">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="center"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/proposta.png" width="83" height="83" alt="picture" /></td>
                      </tr>
                      <tr>
                        <td height="23"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                          <tr>
                            <td width="23" bgcolor="#FFCC66" class="sidespace">&nbsp;</td>
                            <td><table width="100%" border="0" cellspacing="0" cellpadding="5" align="left" class="inner" id="banner3" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                              <tr>
                                <td colspan="4" align="center" bgcolor="#FFCC66">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="4" align="center" bgcolor="#FFFFFF">&nbsp;</td>
                              </tr>
                              <tr>
                                <td width="31%" align="right" bgcolor="#F5F5F5" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Valor da proposta:</td>
                                <td colspan="3" align="left" bgcolor="#F5F5F5" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;">R$ '.converte_valor_real($valor_proposta).'</span></td>
                              </tr>
                              <tr>
                                <td height="20" align="right" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Entrada:</span></td>
                                <td width="28%" height="20" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">R$ '.converte_valor_real($valor_entrada).'</span></td>
                                <td width="12%" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Percentual:</span></td>
                                <td width="29%" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.converte_valor_real((100-($oferta["unidade_preco_desconto"]/100)*$valor_entrada)).'%</td>
                              </tr>
                              <tr>
                                <td height="20" align="right" bgcolor="#F5F5F5"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Parcelas Mensais:</span></td>
                                <td height="20" align="left" bgcolor="#F5F5F5" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$qtd_parcela_mensal.'x '.converte_valor_real($valor_parcela_mensal).'</td>
                                <td height="20" bgcolor="#F5F5F5"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;; font-family: Open Sans, Arial, Helvetica, sans-serif; font-size: 14px">Total:</span></td>
                                <td height="20" bgcolor="#F5F5F5" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">R$ '.converte_valor_real($total_parcela_mensal).'</td>
                              </tr>';
                              if($total_baloes > 0):
                              $i = 1;
                              foreach($baloes as $balao):
                                if($i == 1):
                                $template_email.=
                                '<tr>
                                  <td height="20" rowspan="'.$total_baloes.'" align="right" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Parcelas Balão:</span></td>
                                  <td height="10" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">R$ '.converte_valor_real($balao["valor_parcela_balao"]).'</td>
                                  <td height="10" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-date.png" alt="" width="30" height="30"></span></td>
                                  <td height="10" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.converte_data_portugues($balao["data_parcela_balao"]).'</td>
                                </tr>';
                                else:
                                $template_email.=
                                '<tr>
                                  <td height="10" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">R$ '.converte_valor_real($balao["valor_parcela_balao"]).'</td>
                                  <td height="10" align="center" bgcolor="#FFFFFF"><span class="smallfont" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/icon-date.png" alt="" width="30" height="30"></span></td>
                                  <td height="10" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.converte_data_portugues($balao["data_parcela_balao"]).'</td>
                                </tr>
                                ';
                                endif;
                                $i=$i+1;
                              endforeach;
                              endif;
                              $template_email.=
                              '<tr>
                                <td align="right" bgcolor="#F5F5F5" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Outros Valores:</td>
                                <td colspan="3" align="left" bgcolor="#F5F5F5" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#F90;">R$ '.converte_valor_real($valor_bens_negociaveis).'</span></td>
                                </tr>
                              <tr>
                                <td align="right" bgcolor="#F5F5F5" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">&nbsp;</td>
                                <td colspan="3" align="left" bgcolor="#F5F5F5"  style="font:600 12px Open Sans, Arial, Helvetica, sans-serif; text-align:justify; color:#333;">'.$descricao_bens_negociaveis.'</td>
                              </tr>
                              <tr>
                                <td align="right" bgcolor="#FFFFFF" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Saldo Remanescente:</td>
                                <td colspan="3" align="left" bgcolor="#FFFFFF" class="smallfont" style="font:600 20px Open Sans, Arial, Helvetica, sans-serif; color:#333;"><span style="font:600 25px Open Sans, Arial, Helvetica, sans-serif; color:#399;">R$ '.converte_valor_real($saldo_remanescente).'</span></td>
                              </tr>
                              <tr>
                                <td align="right" bgcolor="#F5F5F5" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Correção  Mensal:</td>
                                <td colspan="3" align="left" bgcolor="#F5F5F5" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$oferta["correcao_parcela_mensal"].'</td>
                              </tr>
                              <tr>
                                <td align="right" bgcolor="#FFFFFF" style="font:600 14px Open Sans, Arial, Helvetica, sans-serif; color:#16c4a9;">Correção  Balão:</td>
                                <td colspan="3" align="left" bgcolor="#FFFFFF" style="font:600 16px Open Sans, Arial, Helvetica, sans-serif; color:#333;">'.$oferta["correcao_parcela_balao"].'</td>
                              </tr>
                              <tr>
                                <td colspan="4" align="justify" bgcolor="#FBFBFB" style="font:12px Open Sans, Arial, Helvetica, sans-serif; color:#333; padding:20px; text-align:justify;">Informamos que sua proposta será enviada para a construtora para análise, no período máximo de <strong>24 horas</strong> você será informado se a mesmo foi aprovada ou não. A proposta não garante a reserva da unidade e também não gera nenhum vínculo com a construtora e/ou incorporadora.</td>
                                </tr>
                              <tr>
                                <td colspan="4" align="center" bgcolor="#FFFFFF" style="font:12px Open Sans, Arial, Helvetica, sans-serif; color:#333;">&nbsp;</td>
                              </tr>
                            </table></td>
                            <td width="23" bgcolor="#FFCC66" class="sidespace">&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                      <tr>
                        <td height="19" align="center" bgcolor="#FFCC66" style="font:16px Arial, Helvetica, sans-serif; font-style:italic; color:#333; padding:0 15px 0 15px;">&nbsp;</td>
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
                    </table></td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">&nbsp;</td>
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
          <td><table width="100%" bgcolor="#00A3D9" border="0" cellspacing="0" cellpadding="0" align="center" class="full" style=" background-image:url(http://sistema.domuslog.com.br/ferramenta/templates_email/https://www.lancamentosonline.com.br/ferramenta/templates_email/images/white-bg.gif); background-repeat:repeat-x; background-position:left top;">
              <tr>
                <td height="23">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><img src="https://www.lancamentosonline.com.br/ferramenta/templates_email/images/lancamentosonline.png" width="83" height="83" alt="picture" /></td>
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
                            <td height="18" align="center" style="font:12px Helvetica,  Arial, sans-serif; color:#AAA;"><p>'.$email_cliente.'</p>
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
</html>
';
?>