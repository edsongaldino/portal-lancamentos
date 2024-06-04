<?php

$url = "https://api.sejda.com/v2/html-pdf";
$content = json_encode(array('url' => $_GET["url"]));

$apiKey = "api_21ABE94D29E74B9FAEFDE8C5B340C42A";


function url_amigavel($string)
{
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z',
        'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
    );
    // Traduz os caracteres em $string, baseado no vetor $table
    $string = strtr($string, $table);
    // converte para minúsculo
    $string = strtolower($string);
    // remove caracteres indesejáveis (que não estão no padrão)
    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
    // Remove múltiplas ocorrências de hífens ou espaços
    $string = preg_replace("/[\s-]+/", " ", $string);
    // Transforma espaços e underscores em hífens
    $string = preg_replace("/[\s_]/", "-", $string);
    // retorna a string
    return $string;
}


$nome_arquivo = url_amigavel($_GET["empreendimento"]);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
  "Content-type: application/json",
  "pageSize: a2",
  "pageOrientation: landscape",
  "Authorization: Token: " . $apiKey)
);

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

$datahora = date('Y-m-d-his');

if($status == 200){
  $fp = fopen("uploads/pdf/".$nome_arquivo.$datahora.".pdf", "w");
  fwrite($fp, $response);
  fclose($fp);
  $mensagem = "O arquivo PDF foi gerado com sucesso! Faça o download abaixo:";
}else{
	$mensagem = ("Error: failed with status $status, response $response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
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
<?php if($status == 200):?>
<div class="img-sucesso"></div>
<div class="mensagem-sucesso"><?php echo $mensagem;?></div>
<a href="uploads/pdf/<?php echo $nome_arquivo.$datahora.".pdf";?>" target="_blank"><div class="btn-download"></div></a>
<?php else:?>
<div class="mensagem-erro"><?php echo $mensagem;?></div>
<?php endif;