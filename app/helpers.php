<?php

use App\Models\BackpackUser;
use App\Models\Bairro;
use App\Models\Caracteristica;
use App\Models\Cidade;
use App\Models\CompradorUnidade;
use App\Models\Construtora;
use App\Models\Empreendimento;
use App\Models\EmpreendimentoPerfil;
use App\Models\Estado;
use App\Models\Foto;
use App\Models\Garagem;
use App\Models\LancamentoFinanceiro;
use App\Models\Planta;
use App\Models\Subtipo;
use App\Models\Torre;
use App\Models\Unidade;

if (!function_exists('percentual_perfil_construtora')) {
    function percentual_perfil($tipo, $id) {

    	switch ($tipo) {
    		case 'usuario':
				$perfil = BackpackUser::find($id)->perfil->toArray();
    			break;
    		case 'construtora':
    			$perfil = Construtora::find($id)->perfil->toArray();
    			break;

    		default:
    			return 0;
    			break;
    	}

		if ($perfil) {
			$completos = function ($perfil) {
			    $totalCompletos = 0;
			    foreach ($perfil as $p) {
			        if ($p['completo'] == 'S') {
			            $totalCompletos++;
			        }
			    }

			    return $totalCompletos;
			};

			$total_itens = count($perfil);
			$total = $total_itens;

			return ($completos($perfil) / $total) * 100;
		}

		return 0;
    }
}

if (!function_exists('percentual_empreendimento')) {
    function percentual_empreendimento($empreendimento)
    {
    	$perfil = $empreendimento->perfil->toArray();
    	return (new EmpreendimentoPerfil())->getPercentual($perfil);
    }
}

if (!function_exists('total_quadras')) {
    function total_quadras($id)
    {
    	$empreendimento = Empreendimento::find($id);
    	if ($empreendimento->quadras) {
    		return $empreendimento->quadras->count();
    	}

    	return 0;
    }
}

if (!function_exists('total_torres')) {
    function total_torres($id)
    {
    	$empreendimento = Empreendimento::find($id);
    	if ($empreendimento->torres) {
    		return $empreendimento->torres->count();
    	}

    	return 0;
    }
}

if (!function_exists('total_pavimentos')) {
    function total_pavimentos($id)
    {
    	$empreendimento = Empreendimento::find($id);
    	if ($empreendimento->pavimentos) {
    		return $empreendimento->pavimentos->count();
    	}

    	return 0;
    }
}

if (!function_exists('caracteristicas_planta')) {
	function caracteristicas_planta($planta_id)
	{
		return Planta::find($planta_id)->caracteristicas->where('exibir', 'Sim')->toArray();
	}
}

if (!function_exists('get_caracteristica')) {
	function get_caracteristica($modelName, $id, $nome, $campo, $pivot = true)
	{
		$caracteristica = null;

		switch ($modelName) {
			case 'Planta':
				$model = Planta::find($id);
				$caracteristica = $model->caracteristicas->where('nome', $nome)->where('tipo', 'Planta');
				break;
			case 'Torre':
				$model = Torre::find($id);
				$caracteristica = $model->caracteristicas->where('nome', $nome)->where('tipo', 'Torre');
				break;

			default:

				break;
		}

		if ($caracteristica && $c = $caracteristica->first()) {

			$c = $c->toArray();

			if ($pivot) {
				return $c['pivot'][$campo];
			}

			return $c[$campo];
		}

		return null;
	}
}

if (!function_exists('unidades')) {
	function unidades($situacao, $empreendimento_id, $construtora_id = null) {

		if ($construtora_id) {
			$construtora = Construtora::find($construtora_id);
			$empreendimentos = $construtora->empreendimentos;
		} else {
			$empreendimentos = Empreendimento::all();
		}

		if ($empreendimento_id && $situacao) {
			$empreendimento = Empreendimento::find($empreendimento_id);

			if ($situacao == 'Todas') {
				return $empreendimento->unidades->count();
			}

			return $empreendimento->unidades()->where('situacao', $situacao)->get()->count();
		}

		$total = 0;

		foreach ($empreendimentos as $empreendimento) {
			if ($empreendimento->status == 'Liberada') {
				if ($situacao == "Todas") {
					$total = $total + $empreendimento->unidades->count();
				} else {
					$total = $total + $empreendimento->unidades()->where('situacao', $situacao)->count();
				}
			}
		}

		return $total;
	}
}

if (!function_exists('empreendimentos')) {
	function empreendimentos($construtora_id)
	{
		if ($construtora_id) {
			return Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada')->count();
		} else {
			return Empreendimento::where('status', 'Liberada')->count();
		}

		return 0;
	}
}

if (!function_exists('percentual_acesso')) {
	function percentual_acesso($construtora_id, $dispositivo) {
		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;
		$total2 = 0;

		foreach ($empreendimentos as $empreendimento) {
			$total += $empreendimento->leads->where('dispositivo', '<>', '')->count();
			$total2 += $empreendimento->leads->where('dispositivo', $dispositivo)->count();
		}

		if($total2) {
			return ($total2 * 100) / $total;
		}

		return 0;
	}
}

if (!function_exists('percentual_origem_acesso')) {
	function percentual_origem_acesso($construtora_id, $origem) {
		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;
		$total2 = 0;

		foreach ($empreendimentos as $empreendimento) {
			$total += $empreendimento->leads->where('origem', '<>', '')->count();
			$total2 += $empreendimento->leads->where('origem', $origem)->count();
		}

		if($total2) {
			return ($total2 * 100) / $total;
		}

		return 0;
	}
}

if (!function_exists('total_views')) {
	function total_views($construtora_id, $mes, $ano) {

		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;

		foreach ($empreendimentos as $empreendimento) {
			$views = $empreendimento->resumo_estatistica()->select('resumo_estatisticas.total')->where('tipo', 'Visualização')->where('ano', $ano)->where('mes', $mes)->get()->first();

			if($views):
				$total += $views->total;
			endif;
		}

		return $total;
	}
}

if (!function_exists('total_cliques')) {
	function total_cliques($construtora_id, $mes, $ano) {

		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;

		foreach ($empreendimentos as $empreendimento) {
			$cliques = $empreendimento->resumo_estatistica()->select('resumo_estatisticas.total')->where('tipo', 'Clique')->where('ano', $ano)->where('mes', $mes)->get()->first();

			if($cliques):
				$total += $cliques->total;
			endif;
		}

		return $total;

	}
}


if (!function_exists('total_leads')) {
	function total_leads($construtora_id, $ano_mes) {

		$data_inicial = $ano_mes.'-01 00:00:01';
		$data_final = $ano_mes.'-31 23:59:00';

		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;

		foreach ($empreendimentos as $empreendimento) {
			$total = Empreendimento::find($empreendimento->id)->leads->whereBetween('created_at', [$data_inicial, $data_final])->count();
		}

		return $total;
	}
}

if (!function_exists('percentual_renda')) {
	function percentual_renda($construtora_id, $renda) {
		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = Empreendimento::where('status', 'Liberada')->get();
		}

		$total =  0;
		$total2 = 0;

		foreach ($empreendimentos as $empreendimento) {
			$total += $empreendimento->leads->where('renda', '<>', '')->count();
			if($renda == "Inicial")	{
				$total2 += $empreendimento->leads->where('renda', '<>' ,'')->count();
			}else{
				$total2 += $empreendimento->leads->where('renda', $renda)->count();
			}
		}

		if($total2) {
			return ($total2 * 100) / $total;
		}

		return 0;
	}
}

if (!function_exists('percentual_interesse')) {
	function percentual_interesse($construtora_id, $interesse) {
		if ($construtora_id) {
			$empreendimentos = Construtora::find($construtora_id)->empreendimentos->where('status', 'Liberada');
		} else {
			$empreendimentos = (new Empreendimento())->where('status', 'Liberada')->get();
		}

		$total =  0;
		$total2 = 0;

		foreach ($empreendimentos as $empreendimento) {
			$total += $empreendimento->leads->count();
			if($interesse == "Inicial")	{
				$total2 += $empreendimento->leads->where('interesse', '<>' ,'')->count();
			}else{
				$total2 += $empreendimento->leads->where('interesse', $interesse)->count();
			}
		}

		if($total2) {
			return ($total2 * 100) / $total;
		}

		return 0;
	}
}

if (!function_exists('get_estados')) {
	function get_estados() {
		return Estado::where('status', 'L')->get();
	}
}

if (!function_exists('get_cidades')) {
	function get_cidades() {
		return Cidade::select('cidades.*')->join('enderecos', 'enderecos.cidade_id', '=', 'cidades.id')->join('empreendimentos', 'empreendimentos.endereco_id', '=', 'enderecos.id')->where('empreendimentos.status', 'Liberada')->groupBy('cidades.id')->get();
	}
}

if (!function_exists('get_bairros')) {
	function get_bairros() {
		return Bairro::where('status', 'L')->get();
	}
}

if (!function_exists('get_subtipos')) {
	function get_subtipos() {
		return Subtipo::all();
	}
}

if (!function_exists('get_construtoras')) {
	function get_construtoras() {
		return Construtora::where('status', 'Liberada')->orderBy('nome_abreviado', 'asc')->get();
	}
}

if (!function_exists('get_empreendimentos')) {
	function get_empreendimentos() {
		if (get_construtora_id()) {
			return Empreendimento::where('construtora_id', get_construtora_id())->where('status', 'Liberada')->orderBy('nome', 'asc')->get();
		}

		return Empreendimento::where('status', 'Liberada')->orderBy('nome', 'asc')->get();
	}
}

if (!function_exists('getimg')) {
	function getimg($url) {
		$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg, image/png';
		$headers[] = 'Connection: Keep-Alive';
		$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
		$user_agent = 'php';
		$process = curl_init($url);
		curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($process, CURLOPT_HEADER, 0);
		curl_setopt($process, CURLOPT_USERAGENT, $user_agent);
		curl_setopt($process, CURLOPT_TIMEOUT, 30);
		curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
		$return = curl_exec($process);
		curl_close($process);
		return $return;
	}
}
if(!function_exists('getFotosCarrossel')){

	function getFotosCarrossel($id){
        return Foto::where('empreendimento_id', $id)
            ->where('destaque_carrossel', 'Sim')
            ->where(function ($q) {
                $q->orWhere('planta_id', null)
                  ->orWhere('planta_id', 0);
            })
            ->where('status', 'Liberada')
            ->get();
    }
}
if(!function_exists('getMapaUnidade')){

	function getMapaUnidade($id){

		if(getenv('APP_ENV') == 'local'){
			return url("assets/images/!logged-empreendimento.jpg");
		}else{

			$diretorio = "uploads/unidade/".$id."/";
			$foto = "www_lancamentosonline_com_br.png";

			if(file_exists($diretorio.$foto)){
				$diretorio = "uploads/unidade/".$id."/";
				$imagename = "www_lancamentosonline_com_br.png";
			}else{
                //KJUVlR0CjjyZU4YG
				$url = "https://v2.convertapi.com/convert/web/to/png?Secret=1zt3Km8Jd4i2MZNc";

				$unidade = Unidade::find($id);

				$implantacao = $unidade->empreendimento->getFotoTipo('Implantação');

				if($implantacao){
					list($largura, $altura) = getimagesize($implantacao);
				}

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$headers = array(
				"Content-Type: application/json",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

				$data = '{
							"Parameters": [
								{
									"Name": "Url",
									"Value": "https://www.lancamentosonline.com.br/unidade/'.$id.'/37/visualizar-mapa/mobile"
								},
								{
									"Name": "StoreFile",
									"Value": true
								},
								{
									"Name": "ImageWidth",
									"Value": "'.$largura.'"
								},
								{
									"Name": "ImageHeight",
									"Value": "'.$altura.'"
								}
							]
						}';

				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				//for debug only!
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$response = curl_exec($curl);

				$obj = json_decode($response);

				$diretorio = "uploads/unidade/".$id."/";

				if(!is_dir($diretorio)){
					mkdir("uploads/unidade/".$id."/", 0755);
				}

                if(isset($obj->Files[0]->Url)){
                    $imgurl = $obj->Files[0]->Url;
                    $imagename = basename($imgurl);
                    if(!file_exists($diretorio.$imagename)){
                        $image = getimg($imgurl);
                        file_put_contents($diretorio.$imagename,$image);
                    }
                }else{
                    return url("assets/images/erro-carregamento-unidade-hor.jpg");
                }

			}
			return url($diretorio.$imagename);
		}

	}
}

if(!function_exists('getImplantacaoUnidade')){

	function getImplantacaoUnidade($id){

		if(getenv('APP_ENV') == 'local'){
			return url("assets/images/!logged-empreendimento.jpg");
		}else{

			$diretorio = "uploads/unidade/".$id."/";
			$foto = "www_lancamentosonline_com_br.png";

			if(file_exists($diretorio.$foto)){
				$diretorio = "uploads/unidade/".$id."/";
				$imagename = "www_lancamentosonline_com_br.png";
			}else{
				$url = "https://v2.convertapi.com/convert/web/to/png?Secret=1zt3Km8Jd4i2MZNc";

				$unidade = Unidade::find($id);

				if($unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first() <> ''){
					$posicao_unidade = $unidade->caracteristicas->where('nome', 'posicao_unidade_torre')->first()->pivot->valor;
				}else{
					$posicao_unidade = 'frente';
				}


				switch($posicao_unidade):

					case 'frente':
						$foto_implantacao = $unidade->empreendimento->getFotoTipo('Implantação Vertical - Frente');
					break;
					case 'fundo':
						$foto_implantacao = $unidade->empreendimento->getFotoTipo('Implantação Vertical - Fundo');
					break;
					case 'lateral':
						$foto_implantacao = $unidade->empreendimento->getFotoTipo('Implantação Vertical - Lateral');
					break;
					default:
						$foto_implantacao = $unidade->empreendimento->getFotoTipo('Implantação Vertical - Frente');
					break;

				endswitch;

				list($largura, $altura) = getimagesize($foto_implantacao);

				$curl = curl_init($url);
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_POST, true);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

				$headers = array(
				"Content-Type: application/json",
				);
				curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

				$data = '{
							"Parameters": [
								{
									"Name": "Url",
									"Value": "https://www.lancamentosonline.com.br/unidade/'.$id.'/37/visualizar-mapa-vertical/'.$posicao_unidade.'"
								},
								{
									"Name": "StoreFile",
									"Value": true
								},
								{
									"Name": "ImageWidth",
									"Value": "'.$largura.'"
								},
								{
									"Name": "ImageHeight",
									"Value": "'.$altura.'"
								}
							]
				}';

				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

				//for debug only!
				curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

				$response = curl_exec($curl);

				$obj = json_decode($response);

				if(!is_dir($diretorio)){
					mkdir("uploads/unidade/".$id."/", 0755);
				}

                if(isset($obj->Files[0]->Url)){
                    $imgurl = $obj->Files[0]->Url;
                    $imagename = basename($imgurl);
                    if(!file_exists($diretorio.$imagename)){
                        $image = getimg($imgurl);
                        file_put_contents($diretorio.$imagename,$image);
                    }
                }else{
                    return url("assets/images/erro-carregamento-unidade.jpg");
                }


			}

			return url($diretorio.$imagename);
		}
	}
}

if (!function_exists('url_amigavel')) {
	function url_amigavel($string) {
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
}

if (!function_exists('total_unidades_oferta')) {
	function total_unidades_oferta($empreendimento) {
		return 0;
	}
}

if (!function_exists('qtd_metragem')) {
	function qtd_metragem($empreendimento, $menor = false) {
		$plantas = $empreendimento->plantas;

		$minimo = 0;
		$maximo = 0;
		$valores = [];
		$texto = null;

		foreach ($plantas as $planta) {
			if ($planta->area_privativa) {
				$valores[] = $planta->area_privativa;
			}
		}

		if ($valores) {
			$minimo = number_format(min($valores), 0, '', '');
			$maximo = number_format(max($valores), 0, '', '');

			if ($menor) {
				return $minimo;
			}

			$texto = $minimo;

			if($minimo != $maximo) {
				$texto = "{$minimo} à {$maximo}";
			}
		}

		return $texto;
	}
}

if (!function_exists('qtd_suites')) {
	function qtd_suites($empreendimento, $range = false) {

		$plantas = $empreendimento->plantas;

		$valores = [];

		foreach ($plantas as $planta) {
			$suite = $planta->caracteristicas->where('nome', 'qtd_suite')->first();
			if ($suite) {
				$valores[] = $suite->pivot->valor;
			}
		}

		if ($valores) {
			$minimo = number_format(min($valores), 0, '', '');
			$maximo = number_format(max($valores), 0, '', '');

			if ($minimo == $maximo) {
				return $minimo;
			}

			if($minimo == 0){
				return $maximo;
			}

			return "{$minimo} à {$maximo}";
		}
	}
}

if (!function_exists('qtd_dormitorio')) {
	function qtd_dormitorio($empreendimento, $range = false) {
		$plantas = $empreendimento->plantas;

		$minimo = 0;
		$maximo = 0;
		$valores = [];
		$texto = null;

		foreach ($plantas as $planta) {

			$caracteristica = $planta->caracteristicas->where('nome', 'Quarto')->where('tipo', 'Planta')->first();

			if ($caracteristica && $caracteristica->pivot->valor > 0) {
				$valores[] = $caracteristica->pivot->valor;
			} else {
				$caracteristica = $planta->caracteristicas->where('nome', 'qtd_dormitorio')->where('tipo', 'Planta')->first();

				if ($caracteristica && $caracteristica->pivot->valor > 0) {
					$valores[] = $caracteristica->pivot->valor;
				}
			}
		}

		if ($valores) {
			$minimo = min($valores);
			$maximo = max($valores);

			$texto = $minimo;

			if (!$range) {
				return $minimo;
			}

			if($minimo != $maximo) {

				if($minimo == 0){
					$texto = "{$maximo} <span class='texto_previsao'>";
				}else{
					$texto = "{$minimo}<span class='texto_previsao'> à </span>{$maximo}<span class='texto_previsao'>";
				}

			}
		}

		return $texto;
	}
}

if (!function_exists('qtd_banheiro')) {
	function qtd_banheiro($empreendimento, $range = false) {
		$plantas = $empreendimento->plantas;

		$minimo = 0;
		$maximo = 0;
		$valores = [];
		$texto = null;

		foreach ($plantas as $planta) {

			$caracteristica = $planta->caracteristicas->where('nome', 'Banheiro')->where('tipo', 'Planta')->first();

			if ($caracteristica && $caracteristica->pivot->valor > 0) {
				$valores[] = $caracteristica->pivot->valor;
			} else {
				$caracteristica = $planta->caracteristicas->where('nome', 'qtd_banheiro')->where('tipo', 'Planta')->first();

				if ($caracteristica && $caracteristica->pivot->valor > 0) {
					$valores[] = $caracteristica->pivot->valor;
				}
			}
		}

		if ($valores) {
			$minimo = min($valores);
			$maximo = max($valores);

			$texto = $minimo;

			if (!$range) {
				return $minimo;
			}

			if($minimo != $maximo) {

				if($minimo == 0){
					$texto = "{$maximo} <span class='texto_previsao'>";
				}else{
					$texto = "{$minimo}<span class='texto_previsao'> à </span>{$maximo}<span class='texto_previsao'>";
				}

			}
		}

		return $texto;
	}
}

if (!function_exists('qtd_vagas')) {
	function qtd_vagas($empreendimento, $tipoEmpreendimento = null, $total = false) {

		$vagas = vagas_padrao_novo($empreendimento);

		if ($vagas) {
			return $vagas;
		}

		$unidades = $empreendimento->unidades;

		$minimoCobertas = 0;
		$minimoDescobertas = 0;
		$maximoCobertas = 0;
		$maximoDescobertas = 0;
		$cobertas = [];
		$descobertas = [];
		$texto_vagas = null;

		foreach ($unidades as $unidade) {
			$valor = $unidade->caracteristicas->where('nome', 'qtd_vaga_coberta')->first();
			if ($valor) {
				$cobertas[] = $valor->pivot->valor;
			}

			$valor = $unidade->caracteristicas->where('nome', 'qtd_vaga_descoberta')->first();

			if ($valor) {
				$descobertas[] = $valor->pivot->valor;
			}

		}

		if ($total) {
			return array_sum($cobertas) + array_sum($descobertas);
		}

		if ($cobertas || $descobertas) {
			$maximoCobertas = max($cobertas);
			$maximoDescobertas = max($descobertas);

			$minimoCobertas = max($cobertas);
			$minimoDescobertas = min($descobertas);

			$total_vagas = $maximoCobertas + $maximoDescobertas;

			if (($total_vagas - 1) == $minimoCobertas) {
				if ($minimoCobertas == 0) {
					$texto_vagas = $total_vagas;
				}else{
					$texto_vagas = $minimoCobertas." e ".$total_vagas;
				}
			} else {
				if ($minimoCobertas == 0) {
					if ($minimoDescobertas == 0) {
						$texto_vagas = $total_vagas;
					} else {
						$texto_vagas = $minimoDescobertas ." à ".$total_vagas;
					}
				} else {
					if ($minimoCobertas == $total_vagas) {
						$texto_vagas = $total_vagas;
					} else {
						$texto_vagas = $minimoCobertas." à ".$total_vagas;
					}
				}
			}

			return $texto_vagas;
		}
	}

	function vagas_padrao_novo($empreendimento) {
		$plantas = $empreendimento->plantas;
		if ($plantas) {

			$vagas = [];

			foreach ($plantas as $planta) {
				$vaga = $planta->caracteristicas->where('nome', 'vagas_garagem')->first();
				if ($vaga) {
					if ($vaga->pivot->valor) {
						$vagas[] = $vaga->pivot->valor;
					}
				}
			}

			if ($vagas) {
				$minimo = min($vagas);
				$maximo = max($vagas);

				if ($minimo == $maximo) {
					return $minimo;
				}

				return "{$minimo} à {$maximo}";
			}
		}

		return false;
	}
}

if (!function_exists('vagas_empreendimento')) {
	function vagas_empreendimento($empreendimento) {
		$unidades = $empreendimento->unidades;
		if ($unidades) {

			$vagas = [];

			foreach ($unidades as $unidade) {
				$vaga = $unidade->caracteristicas->where('nome', 'vagas_garagem')->first();
				if ($vaga) {
					if ($vaga->pivot->valor) {
						$vagas[] = $vaga->pivot->valor;
					}
				}
			}

			if ($vagas) {
				$minimo = min($vagas);
				$maximo = max($vagas);

				if ($minimo == $maximo) {
					return $minimo;
				}

				return "{$minimo} à {$maximo}";
			}
		}

		return false;
	}
}

if (!function_exists('converte_valor_real')) {

	function converte_valor_real($valor) {
		if (is_numeric($valor)) {
			try {
				$valor = number_format($valor,2,",",".");
			} catch (\Exception $e) {
				return $valor;
			}

			if($valor > 0) {
				return $valor;
			} else {
				return 0;
			}
		}
	}
}

if (!function_exists('converte_valor_real_semdecimal')) {

	function converte_valor_real_semdecimal($valor) {
		if (is_numeric($valor)) {
			try {
				$valor = number_format($valor,0,",",".");
			} catch (\Exception $e) {
				return $valor;
			}

			if($valor > 0) {
				return $valor;
			} else {
				return 0;
			}
		}
	}
}

if (!function_exists('converte_reais_to_mysql')) {
	function converte_reais_to_mysql($valor) {
		$valor = str_replace('.', '', $valor);
		$valor = str_replace(',', '.', $valor);

		return $valor;
	}
}

if (!function_exists('isMobile')) {
	function isMobile() {
		$detect = new \Mobile_Detect();
		return $detect->isMobile();
	}
}

if (!function_exists('isAndroid')) {
	function isAndroid() {
		$detect = new \Mobile_Detect();
		return $detect->isAndroidOS();
	}
}

if (!function_exists('isAdmin')) {
	function isAdmin() {
		foreach (Auth::user()->getRoleNames() as $role) {
			if ($role == 'Administrador') {
				return true;
			}
		}
		return false;
	}
}

if (!function_exists('get_construtora_id')) {
	function get_construtora_id() {
		return \Auth::user()->construtora_id;
	}
}

if (!function_exists('masc_telefone')) {
	function masc_telefone($TEL) {
		$tam = strlen(preg_replace("/[^0-9]/", "", $TEL));
		if ($tam == 13) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS e 9 dígitos
		return "+".substr($TEL,0,$tam-11)."(".substr($TEL,$tam-11,2).") ".substr($TEL,$tam-9,5)."-".substr($TEL,-4);
		}
		if ($tam == 12) { // COM CÓDIGO DE ÁREA NACIONAL E DO PAIS
		return "+".substr($TEL,0,$tam-10)."(".substr($TEL,$tam-10,2).") ".substr($TEL,$tam-8,4)."-".substr($TEL,-4);
		}
		if ($tam == 11) { // COM CÓDIGO DE ÁREA NACIONAL e 9 dígitos
		return "(".substr($TEL,0,2).") ".substr($TEL,2,5)."-".substr($TEL,7,11);
		}
		if ($tam == 10) { // COM CÓDIGO DE ÁREA NACIONAL
		return "(".substr($TEL,0,2).") ".substr($TEL,2,4)."-".substr($TEL,6,10);
		}
		if ($tam <= 9) { // SEM CÓDIGO DE ÁREA
		return substr($TEL,0,$tam-4)."-".substr($TEL,-4);
		}
	}
}

if (!function_exists('total_construtoras')) {
	function total_construtoras() {
		return Construtora::where('status', 'Liberada')->count();
	}
}

if (!function_exists('total_empreendimentos')) {
	function total_empreendimentos() {
		return Empreendimento::where('status', 'Liberada')->count();
	}
}

if (!function_exists('total_unidades')) {
	function total_unidades() {
		return Unidade::where('status', 'Liberada')->where('situacao', 'Disponível')->count();
	}
}

if (!function_exists('unidade_vagas')) {

	function unidade_vagas($id) {
		$vagas = Garagem::where('unidade_id', $id)->get();
		$i = 0;
        $unidade_vagas = '';
        foreach($vagas as $vaga){
            if($vagas->count() > 1){
                if($i == 1){
                    $unidade_vagas .= ' e '.$vaga->nome;
                }else{
                    $unidade_vagas = $vaga->nome;
                }
            }else{
                $unidade_vagas = $vaga->nome;
            }
            $i = $i+1;
        }

        return $unidade_vagas;
	}
}

if (!function_exists('total_unidades_construtora')) {
	function total_unidades_construtora($construtora) {
		return Unidade::where('unidades.construtora_id', $construtora->id)
			->join('empreendimentos', 'unidades.empreendimento_id', '=', 'empreendimentos.id')
			->where('unidades.status', 'Liberada')
			->where('empreendimentos.status', 'Liberada')
			->where('unidades.situacao', 'Disponível')
			->count();
	}
}

if (!function_exists('remove_caracter_especial')) {
	function remove_caracter_especial($texto) {
	$texto = strtolower(strtr($texto, "�������������������������� -", "aaaaeeiooouucAAAAEEIOOOUUC  "));
	$texto = preg_replace("[^a-zA-Z0-9_]", "", $texto);

	return $texto;
	}
}

if (!function_exists('limpa_campo')) {
	function limpa_campo($valor) {
	$valor = preg_replace("/\D+/", "", $valor); // remove qualquer caracter não numérico
	return $valor;
	}
}

if (!function_exists('mes_extenso_abreviado')) {
	function mes_extenso_abreviado($mes) {

		$mes_extenso = "";

		switch($mes) {
			case "01":
				$mes_extenso = "JAN";
				break;
			case "02":
				$mes_extenso = "FEV";
				break;
			case "03":
				$mes_extenso = "MAR";
				break;
			case "04":
				$mes_extenso = "ABR";
				break;
			case "05":
				$mes_extenso = "MAI";
				break;
			case "06":
				$mes_extenso = "JUN";
				break;
			case "07":
				$mes_extenso = "JUL";
				break;
			case "08":
				$mes_extenso = "AGO";
				break;
			case "09":
				$mes_extenso = "SET";
				break;
			case "10":
				$mes_extenso = "OUT";
				break;
			case "11":
				$mes_extenso = "NOV";
				break;
			case "12":
				$mes_extenso = "DEZ";
				break;
		}

		return ucfirst($mes_extenso);
	}
}

if (!function_exists('converte_utf8')) {
	function converte_utf8($string) {
		if (utf8_decode($string) == $string) {
		  return utf8_decode($string);
		} else {
		  return $string;
		}
	}
}

if (!function_exists('atribuir_caracteristica')) {
	function atribuir_caracteristica($request, $model, $tipo, $caracteristicas) {

		foreach ($caracteristicas as $caracteristica) {

			$item = Caracteristica::where('nome', $caracteristica)->where('tipo', $tipo)->first();

	        if ($item) {

				$model->caracteristicas()->detach($item->id);
				$model->caracteristicas()->attach($item, [
					'valor' => $request->{$caracteristica}
				]);

				if ($request->{$caracteristica} == '0') {
	                $model->caracteristicas()->detach($item->id);
				}

	        }
	    }
	}
}

if (!function_exists('validar_cep')) {
	function validar_cep($cep) {
	    $cep = trim($cep);

	    if(preg_match("/[0-9]{5,5}([- ]?[0-9]{4})?$/", $cep)) {
	    	return true;
	    }

	    return false;
	}
}

if (!function_exists('atribuir_caracteristica_manual')) {
	function atribuir_caracteristica_manual($valor, $model, $tipo, $caracteristica, $parametros = []) {
        $item = Caracteristica::where('nome', $caracteristica)->where('tipo', $tipo)->first();
        if ($item) {

			if(isset($parametros["tipo"])){
				if($parametros["tipo"] == "valor"){
					$valor = converte_reais_to_mysql($valor);
				}
			}

            $model->caracteristicas()->detach($item->id);
            $model->caracteristicas()->attach($item, [
                'valor' => $valor
            ]);
        }
	}
}

if (!function_exists('get_texto_quarto_suite')) {
	function get_texto_quarto_suite($empreendimento) {

      	$quartos = qtd_dormitorio($empreendimento, true);

      	$suites = qtd_suites($empreendimento, true);

        if ($quartos == $suites) {
          return "{$suites} Suítes";
        } else {
        	if ($suites) {
        		return "{$quartos} Quarto(s) sendo {$suites} suítes";
        	} else {
        		return "{$quartos} Quarto(s)";
        	}
        }
	}
}

if (!function_exists('get_texto_vagas')) {
	function get_texto_vagas($unidade) {

		$vagas = Garagem::where('unidade_id', $unidade)->get();
		$total = $vagas->count();
		$texto_vagas = '';
		if($total > 0){

			$i = 0;
			foreach($vagas as $vaga){
				if($total == 1){
					$texto_vagas = 'Vaga Nº '.$vaga->nome;
				}else{
					$i = $i+1;
					if($i < $total){
						$texto_vagas.= 'Vagas Nº '.$vaga->nome.' e ';
					}else{
						$texto_vagas.= $vaga->nome;
					}

				}

			}

		}
		return $texto_vagas;
	}
}

if (!function_exists('get_total_vagas_unidade')) {
	function get_total_vagas_unidade($unidade) {
		$total = Garagem::where('unidade_id', $unidade)->count();
		return $total;
	}
}

if (!function_exists('filemtime')) {
	function filemtime($url) {
		$url_saida = filemtime($url);
		return $url_saida;
	}
}

if (!function_exists('get_elevadores')) {
	function get_elevadores($empreendimento) {
		$torres = Torre::where('empreendimento_id', $empreendimento)->get();

		$elevador_social = 0;
		$elevador_servico = 0;

		foreach($torres as $torre){
			
			if($torre->caracteristicas->where('nome', 'elevador_social')->first()){
				$elevador_social += $torre->caracteristicas->where('nome', 'elevador_social')->first()->pivot->valor;
			}

			if($torre->caracteristicas->where('nome', 'elevador_servico')->first()){
				$elevador_servico += $torre->caracteristicas->where('nome', 'elevador_servico')->first()->pivot->valor;
			}

		}

		return $elevador_social + $elevador_servico;

	}
}



if (!function_exists('get_previsao_entrega')) {
	function get_previsao_entrega($empreendimento) {
        if ($empreendimento->tipo == 'Vertical') {

        	$torres = $empreendimento->torres;

        	$valores = [];

        	foreach ($torres as $torre) {
        		if ($torre->previsao_entrega_ano && $torre->previsao_entrega_mes) {
        			$valores[] = "{$torre->previsao_entrega_ano}-{$torre->previsao_entrega_mes}";
        		}
        	}

        	if (!$valores) {
        		return 'Em breve';
        	}

        	$min = min($valores);
        	$explode = explode('-', $min);

        	$torre = $empreendimento->torres->where('previsao_entrega_ano', $explode[0])->where('previsao_entrega_mes', $explode[1])->first();

        	if ($torre) {
        		$data = "{$torre->previsao_entrega_ano}-{$torre->previsao_entrega_mes}";
        		if ($data <= (new \DateTime())->format('Y-m')) {
        			return 'Pronto';
        		}

        		$mes_abreviado = mes_extenso_abreviado($torre->previsao_entrega_mes);

        		if (!$mes_abreviado) {
					return $torre->previsao_entrega_ano;
        		}

        		return "{$mes_abreviado}/{$torre->previsao_entrega_ano}";
        	}

        	return 'Em breve';
        }

        if ($empreendimento->tipo == 'Horizontal') {
        	$quadras = $empreendimento->quadras;

        	$valores = [];

        	foreach ($quadras as $quadra) {
        		if ($quadra->previsao_entrega_ano && $quadra->previsao_entrega_mes) {
        			$valores[] = "{$quadra->previsao_entrega_ano}-{$quadra->previsao_entrega_mes}";
        		}
        	}

        	if (!$valores) {
        		return 'Em breve';
        	}

        	$min = min($valores);
        	$explode = explode('-', $min);

        	$quadra = $empreendimento->quadras->where('previsao_entrega_ano', $explode[0])->where('previsao_entrega_mes', $explode[1])->first();

        	if ($quadra) {

        		$data = "{$quadra->previsao_entrega_ano}-{$quadra->previsao_entrega_mes}";

        		if ($data <= (new \DateTime())->format('Y-m')) {
        			return 'Pronto';
        		}

        		$mes_abreviado = mes_extenso_abreviado($quadra->previsao_entrega_mes);

        		if (!$mes_abreviado) {
					return $quadra->previsao_entrega_ano;
        		}

        		return "{$mes_abreviado}/{$quadra->previsao_entrega_ano}";
        	}


    		return 'Em breve';
        }
	}
}

if (!function_exists('dump_query')) {
	function dump_query($query) {
      	$resultado = str_replace(array('?'), array('\'%s\''), $query->toSql());
      	$resultado = vsprintf($resultado, $query->getBindings());
      	return $resultado;
	}
}

if (!function_exists('url_possui')) {
	function url_possui($texto) {
		$url = url()->current();
		if (strpos($url, $texto) !== false) {
		    return true;
		}

		return false;
	}
}

if (!function_exists('perfil_empreendimento')) {
	function perfil_empreendimento($empreendimento) {
    	return $empreendimento->perfil->toArray();
	}
}

if (!function_exists('data_br')) {
	function data_br($data) {
		if ($data) {
			try {
				return (new \DateTime($data))->format('d/m/Y');
			} catch (\Exception $e) {

			}
		}
	}
}

if (!function_exists('data_mysql')) {
	function data_mysql($data) {
		if ($data) {
			$ano= substr($data, 6);
			$mes= substr($data, 3,-5);
			$dia= substr($data, 0,-8);
			return $ano."-".$mes."-".$dia;
		}
	}
}

if (!function_exists('hora_br')) {
	function hora_br($data) {
		if ($data) {
			return (new \DateTime($data))->format('H:i\h');
		}
	}
}

if (!function_exists('total_vgv_geral')) {

	function total_vgv_geral($construtora_id, $empreendimento_id = null) {
		$total = 0;

		if (!$construtora_id) {
			return [];
		}

		if ($empreendimento_id) {
			$unidades = Unidade::where('empreendimento_id', $empreendimento_id)->get();
		} else {
			$unidades = Unidade::where('construtora_id', $construtora_id)->get();
		}

		foreach ($unidades as $un) {

			if($un->situacao == 'Vendida'){

				$venda = CompradorUnidade::where('unidade_id', $un->id)->where('valor','>','0.00')->count();

				if($venda > 0){
					$valor_venda = CompradorUnidade::where('unidade_id', $un->id)->where('valor','>','0.00')->select('valor')->get();
					foreach($valor_venda as $vl){

						$valor = converte_reais_to_mysql($vl->valor);
						$total += $valor;

					}
				}else{
					$valor = obter_valor_unidade($un);
					$total += ($valor);
				}

			}else{
				$valor = obter_valor_unidade($un);
				$total += ($valor);
			}
		}


		return $total;
	}
}

if (!function_exists('total_valor_unidade')) {

	function total_valor_unidade($construtora_id, $empreendimento_id = null, $situacao = null) {
		$total = 0;

		if($situacao == 'Vendida'){

			if ($empreendimento_id) {
				$total = CompradorUnidade::where('empreendimento_id', $empreendimento_id)->sum('valor');
			} else {
				$total = CompradorUnidade::where('construtora_id', $construtora_id)->sum('valor');
			}

		}else{

			if (!$construtora_id) {
				return [];
			}

			if ($empreendimento_id) {
				$unidades = Unidade::where('empreendimento_id', $empreendimento_id)->get();
			} else {
				$unidades = Construtora::find($construtora_id)->unidades;
			}

			foreach ($unidades as $un) {
				if ($situacao) {
					if ($situacao && $un->situacao == $situacao) {
						$valor = obter_valor_unidade($un);
						$total += ($valor);
					}
				} else {
					$valor = obter_valor_unidade($un);
					$total += ($valor);
				}
			}

		}

		return $total;
	}
}

if (!function_exists('total_vagas_unidade')) {
	function total_vagas_unidade($unidade) {
		$total = 0;

		$total_garagens = Garagem::where('unidade_id', $unidade)->count();
		$unidade = Unidade::find($unidade);

		if($total_garagens > 0){
			$total = $total_garagens;
		}else{
			$total = $unidade->caracteristicas->where('nome', 'vagas_garagem')->first()->pivot->valor ?? '';
		}

		return $total;
	}
}

if (!function_exists('obter_valor_unidade')) {

	function obter_valor_unidade($unidade) {
		
		$valor_unidade = 0;

		$valor = $unidade->caracteristicas->where('nome', 'valor_unidade')->first();

		if ($valor) {
			
			$valor = $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor;

			if($valor > 0){
				$valor_unidade = $valor;
			}else{
				$valor_unidade = obter_valor_unidade_por_m2($unidade);
			}

		} else {

			$valor_unidade = obter_valor_unidade_por_m2($unidade);
		}

		return $valor_unidade;
	}

}

if (!function_exists('obter_valor_unidade_por_m2')) {

	function obter_valor_unidade_por_m2($unidade) {

		$valor_unidade = 0;

		$valor = $unidade->caracteristicas->where('nome', 'valor_m2')->first();

		if ($valor) {

			$metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first();

			if ($metragem) {
				$valor_unidade = ($valor->pivot->valor * $metragem->pivot->valor);
			}
		}

		return $valor_unidade;
	}

}

if (!function_exists('get_valor_unidade')) {

	function get_valor_unidade($unidade) {
		if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> ''){
			$valor_unidade = converte_valor_real($unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor);
		}else{

			if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first()){

					$valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
					$metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;

					$valor_unidade = converte_valor_real($valor_m2 * $metragem);
			}else{
				$valor_unidade = 'Consulte';
			}
		}

		return $valor_unidade;
	}

}




if (!function_exists('total_valor_honorario')) {
	function total_valor_honorario($construtora_id, $empreendimento_id = null) {
		$total = 0;

		if (!$construtora_id) {
			return [];
		}

		if ($empreendimento_id) {
			$compradores = Empreendimento::find($empreendimento_id)->compradores;
		} else {
			$compradores = Construtora::find($construtora_id)->compradores;
		}

		foreach ($compradores as $c) {
			$valor = 0;

			$valor_honorario = $c->getOriginal('valor_honorario');

			if ($valor_honorario) {
				$valor = $valor_honorario;
			}

			$total += (floatval($valor));
		}

		return $total;

	}
}

if (!function_exists('mensalidade_atraso')) {
	function mensalidade_atraso() {
		$construtora_id = get_construtora_id();
		$lancamentos = LancamentoFinanceiro::where('construtora_id', $construtora_id)->get();
		if (count($lancamentos)) {
			foreach ($lancamentos as $l) {
				if (lancamento_vencido($l)) {
					return true;
				}
			}
		}

		return false;
	}
}

if (!function_exists('lancamento_vencido')) {
	function lancamento_vencido($lancamento) {
		$hoje = (new \DateTime())->format('Y-m-d');
		if ($lancamento->situacao == 'Aberto' && $lancamento->getOriginal('vencimento') < $hoje) {
			return true;
		}
		return false;
	}
}

if (!function_exists('calcular_valor')) {

	function calcular_valor($valor_cheio, $percentual, $tipo, $tabela)
    {
		if($tipo == 'Entrada'){
			//var_dump($valor_cheio);
			$resultado = floatval($valor_cheio) * (floatval($percentual) / 100);
			return $resultado;
		}

		if($tipo == 'Mensal'){
			//var_dump($valor_cheio);
			$resultado = (floatval($valor_cheio) * (floatval($percentual) / 100)/$tabela->qtd_mensais);
			return $resultado;
		}

		if($tipo == 'Balao'){
			//var_dump($valor_cheio);
			$resultado = (floatval($valor_cheio) * (floatval($percentual) / 100)/$tabela->qtd_baloes);
			return $resultado;
		}

		if($tipo == 'TotalBalao'){
			//var_dump($valor_cheio);
			$resultado = (floatval($valor_cheio) * (floatval($percentual) / 100));
			return $resultado;
		}

		if($tipo == 'Chaves'){
			//var_dump($valor_cheio);
			$resultado = floatval($valor_cheio) * (floatval($percentual) / 100);
			return $resultado;
		}

		if($tipo == 'DescontoAvista'){
			//var_dump($valor_cheio);
			$resultado = floatval($valor_cheio) * (floatval($percentual) / 100);
			return $resultado;
		}

		if($tipo == 'ValorComDesconto'){
			//var_dump($valor_cheio);
			$desconto = floatval($valor_cheio) * (floatval($percentual) / 100);
			$resultado = floatval($valor_cheio) - floatval($desconto);
			return $resultado;
		}

		if($tipo == 'Saldo'){
			//var_dump($valor_cheio);
			$saldo = floatval($valor_cheio) * (floatval($percentual) / 100);
			return $saldo;
		}

    }

}

if (!function_exists('calcular_percentual')) {

	function calcular_percentual($valor_cheio, $valor, $tipo, $tabela)
    {
		if($tipo == ''){
			//var_dump($valor_cheio);
			return $resultado = (floatval($valor) / floatval($valor_cheio)) * 100;
		}

    }

}

if (!function_exists('valor_unidade')) {

	function valor_unidade($unidade)
    {
		if($unidade->caracteristicas->where('nome', 'valor_unidade')->first() && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '' && $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor <> '0'){
			$valor = $unidade->caracteristicas->where('nome', 'valor_unidade')->first()->pivot->valor;
		}else{
			if($unidade->caracteristicas->where('nome', 'valor_m2')->first() && $unidade->caracteristicas->where('nome', 'metragem_total')->first()){

				$valor_m2 = $unidade->caracteristicas->where('nome', 'valor_m2')->first()->pivot->valor;
				$metragem = $unidade->caracteristicas->where('nome', 'metragem_total')->first()->pivot->valor;
				$valor = ($valor_m2 || '0') * ($metragem || '0');
			}else{
				$valor = 0;
			}
		}

		return $valor;

    }

}
