<?php

$urlMapa = $_GET["url"];
$empreendimento = $_GET["empreendimento"];

function pdfshift($apiKey, $params) {
  
  $curl = curl_init();

  curl_setopt_array ($curl, array (
      CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($params),
      CURLOPT_HTTPHEADER => array ('Content-Type:application/json'),
      CURLOPT_USERPWD => $apiKey.':'
  ));

  $response = curl_exec($curl);
  $error = curl_error($curl);
  $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);

  if (!empty($error)) {
      throw new Exception($error);
  } elseif ($statusCode >= 400) {
      $body = json_decode($response, true);
      if (isset($body['error'])) {
          throw new Exception($body['error']);
      } else {
          throw new Exception($response);
      }
  }

  return $response;

}

$apiChave = 'c3288f6d8d9b40ff801e67ef40591797';
$response = pdfshift($apiChave, array (
  'source' => $urlMapa,
  'landscape' => 'true',
  'format' => 'A2',
  'auth' => array (
      'username' => 'user',
      'password' => 'passwd'
  )
));

$datahora = date('Y-m-d-his');

$fp = fopen("uploads/pdf/PDFmapa_".$empreendimento.$datahora.".pdf", "w");
fwrite($fp, $response);
fclose($fp);
$mensagem = "O arquivo PDF foi gerado com sucesso! Faça o download abaixo:";
    
?>

<style>
.mensagem-sucesso{
	width: 80%;
	height: auto;
	margin: auto;
	font-size: 30px;
	text-align: center;
	color: #00B2B2;
	padding: 20px 0 20px 0;
	font-family: Helvetica, Arial, 'Liberation Sans', FreeSans, sans-serif;
}

.mensagem-erro{
	width: 80%;
	height: auto;
	margin: auto;
	font-size: 20px;
	text-align: center;
	color: #D90000;
	padding: 20px 0 20px 0;
	font-family: Helvetica, Arial, 'Liberation Sans', FreeSans, sans-serif;
}

.btn-download{
	width: 250px;
	height: 50px;
	margin: auto;
	background-image: url(site/imagem/btn-download-mapa.png);
	background-repeat: no-repeat;
}

.img-sucesso{
	width: 150px;
	height: 150px;
	margin: auto;
	background-image: url(site/imagem/img-sucesso.png);
	background-repeat: no-repeat;
}
</style>

<div class="img-sucesso"></div>
<div class="mensagem-sucesso"><?php echo $mensagem;?></div>
<a href="uploads/pdf/PDFmapa_<?php echo $empreendimento.$datahora;?>.pdf" target="_blank"><div class="btn-download"></div></a>
