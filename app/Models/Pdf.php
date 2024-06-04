<?php

namespace App\Models;

class Pdf 
{
	protected $apiChave = 'c3288f6d8d9b40ff801e67ef40591797';

	public function gerar($url)
	{            
	    $params =  [
	    	'source' => $url,
	    	'landscape' => 'true',
			'format' => 'A2',
			'filename' => 'MapaCondominio.pdf',
	    	'auth' => [
	        	'username' => 'user',
	        	'password' => 'passwd'
	    	]
	    ];

	    $curl = curl_init();
	    curl_setopt_array ($curl, array (
	        CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => json_encode($params),
	        CURLOPT_HTTPHEADER => array ('Content-Type:application/json'),
	        CURLOPT_USERPWD => $this->apiChave.':'
	    ));

	    $response = curl_exec($curl);
	    
	    $error = curl_error($curl);
	    
	    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	    
	    curl_close($curl);

	    if (!empty($error)) {
	        throw new \Exception($error);
	    } elseif ($statusCode >= 400) {
	        $body = json_decode($response, true);
	        if (isset($body['error'])) {
	            throw new \Exception($body['error']);
	        } else {
	            throw new \Exception($response);
	        }
	    }

	    return $response;
	}

	public function gerarPDFUnidade($url)
	{            
	    $params =  [
	    	'source' => $url,
			'landscape' => 'false',
			'margin' => '10px',
	    	'format' => 'A4',
	    	'auth' => [
	        	'username' => 'user',
	        	'password' => 'passwd'
	    	]
	    ];

	    $curl = curl_init();
	    curl_setopt_array ($curl, array (
	        CURLOPT_URL => "https://api.pdfshift.io/v2/convert/",
	        CURLOPT_RETURNTRANSFER => true,
	        CURLOPT_POST => true,
	        CURLOPT_POSTFIELDS => json_encode($params),
	        CURLOPT_HTTPHEADER => array ('Content-Type:application/json'),
	        CURLOPT_USERPWD => $this->apiChave.':'
	    ));

	    $response = curl_exec($curl);
	    
	    $error = curl_error($curl);
	    
	    $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	    
	    curl_close($curl);

	    if (!empty($error)) {
	        throw new \Exception($error);
	    } elseif ($statusCode >= 400) {
	        $body = json_decode($response, true);
	        if (isset($body['error'])) {
	            throw new \Exception($body['error']);
	        } else {
	            throw new \Exception($response);
	        }
	    }

	    return $response;
	}
}