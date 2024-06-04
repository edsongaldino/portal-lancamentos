<?php

namespace App\Models;

use App\Models\ConstrutoraPerfil;
use Illuminate\Support\Facades\DB;
use \Image;

class Importacao
{
	public function importar()
	{		
		// $this->localidades();
		// $this->construtoras();
		// $this->subtipos();
		// $this->variacoes();
		//$this->empreendimentos();
		//$this->infraestruturas();
		//$this->itensLazer();
		//$this->proximidades();		
		//$this->quadras();
		//$this->torres();
		//$this->plantas();	
		//$this->unidades();
		// $this->dadosCondominio();
		// $this->usuarios();
		//$this->fotos();
		// $this->seoEmpreendimentos();
		// $this->contatosConstrutora();
		//$this->atribuirAndares();
		// $this->noticias();
		//$this->leads();
		// $this->gerarPerfilEmpreendimento();
		// $this->cadastrarUsuarioConstrutora();
		//$this->gerarLogosConstrutoras();
		//$this->importarCaracteristicasPlantas();
		//$this->setarIdFotosPlantas();
		//$this->gerarPerfilConstrutora();
		//$this->salvarLatitudeLongitudeEndereco();
		//$this->setarAreaPrivativaPlantas();
		//$this->corrigirConstrutoraIdQuadras();
		//$this->corrigirFotosDuplicadas();
		//$this->corrigirFotosPlantas();
		//$this->corrigirValorUnidades();
		//$this->corrigirValorMetragem();
		//$this->setarConstrutoraIdToCompradores();
		$this->importarCaracteristicasUnidades();
	}

	public function localidades()
	{
		try {
		    
		    $estados = DB::connection('banco_lancamentos')->select("select * from site_estados");

	    	DB::beginTransaction();

		    foreach ($estados as $estado) {

		    	echo("Importando estado {$estado->nome}") . "\n";

		    	$existe = Estado::find($estado->id_estado);

		    	$id_estado = $estado->id_estado;

		    	$model = new Estado();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}
		    	
		    	if (!$existe) {
	    			$model->id = $id_estado;
	    		}

	    		$model->uf = $estado->uf;
	    		$model->nome = $estado->nome;
	    		$model->status = $estado->status;
	    		$model->save();
	    		$estado_id = $model->id;

	    		if ($estado->nome == 'Goiás' && $estado->id_estado != 14) {
	    			continue;
	    		}

	    		if ($estado->nome == 'São Paulo' && $estado->id_estado != 15) {
	    			continue;
	    		}
		    	
		    	$cidades = DB::connection('banco_lancamentos')->select('select * from site_cidades where id_estado = ?', [$id_estado]);

		    	foreach ($cidades as $cidade) {
		    		echo("Importando cidade {$cidade->nome}") . "\n";
		    		
		    		$existe = Cidade::find($cidade->id_cidade);

		    		$id_cidade = $cidade->id_cidade;

		    		$model = new Cidade();
		    		
		    		if ($existe) {
		    			$model = $existe;
		    		}
		    		
		    		if (!$existe) {
	    				$model->id = $id_cidade;
	    			}

	    			$model->estado_id = $estado_id;
	    			$model->nome = $cidade->nome;
	    			$model->status = $cidade->status;
	    			$model->save();

		    		$bairros = DB::connection('banco_lancamentos')->select('select * from site_bairros where id_cidade = ?', [$id_cidade]);

		    		foreach ($bairros as $bairro) {
		    			
		    			echo("Importando bairro {$bairro->nome}") . "\n";

		    			$existe = Bairro::find($bairro->id_bairro);

		    			$id_bairro = $bairro->id_bairro;

		    			$model = new Bairro();
		    			
		    			if ($existe) {
		    				$model = $existe;
		    			}

		    			if (!$existe) {
		    				$model->id = $id_bairro;
		    			}

	    				$model->cidade_id = $id_cidade;
	    				$model->nome = $bairro->nome;
	    				$model->status = $bairro->status;	    				
	    				$model->save();
		    		}
		    	}
		    }

	    	DB::commit();
		   	
		   	echo('Importação de endereços finalizada') . "\n";
		    
		} catch (\Exception $e) {
		    DB::rollback();
		    return $e->getMessage();
		}
	}

	public function subtipos()
	{
		try {
			
			$items = DB::connection('banco_lancamentos')->select("select * from empreendimento_tipo");

			DB::beginTransaction();

		    foreach ($items as $item) {
		    	echo("Importando subtipo {$item->descricao_empreendimento_tipo}") . "\n";

		    	$existe = Subtipo::find($item->codigo_empreendimento_tipo);

		    	$model = new Subtipo();

		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	if (!$existe) {
		    		$model->id = $item->codigo_empreendimento_tipo;
		    	}
	    		
	    		$model->nome = $item->descricao_empreendimento_tipo;

	    		if ($item->codigo_empreendimento_tipo == 1 or $item->codigo_empreendimento_tipo == 2) {
	    			$model->tipo = 'Vertical';
	    		}

	    		if ($item->codigo_empreendimento_tipo == 3 or $item->codigo_empreendimento_tipo == 4) {
	    			$model->tipo = 'Horizontal';
	    		}

	    		$model->save();
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de subtipos finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    return $e->getMessage();
		}
	}

	public function variacoes()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select("select * from empreendimento_subtipo");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	echo("Importando variacao {$item->descricao_empreendimento_subtipo}") . "\n";

		    	$existe = Variacao::find($item->codigo_empreendimento_subtipo);

	    		$model = new Variacao();

		    	if ($existe) {	    		
		    		$model = $existe;
		    	}

		    	if (!$existe) {
		    		$model->id = $item->codigo_empreendimento_subtipo;
		    	}
		 
	    		$model->nome = $item->descricao_empreendimento_subtipo;
	    		$model->save();
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de variacoes finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    return $e->getMessage();
		}
	}

	public function infraestruturas()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select("
				SELECT a.*, b.id_empreendimento FROM site_infraestruturas a
				INNER JOIN empreendimentos_infraestruturas b 
				ON a.id_infraestrutura = b.id_infraestrutura
			");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	echo("Importando infraestrutura {$item->nome}") . "\n";

		    	$existe = Caracteristica::where('id_antigo', $item->id_infraestrutura)
		    		->where('tipo', 'Empreendimento')
		    		->where('nome', $item->nome)
		    		->get()
		    		->first();

		    	$model = new Caracteristica();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}	
		    	
	    		$model->nome = $item->nome;
				$model->id_antigo = $item->id_infraestrutura;
	    		$model->tipo = 'Empreendimento';
	    		$model->save();

	    		$empreendimento = Empreendimento::find($item->id_empreendimento);

	    		$caracteristica = $empreendimento
	    			->caracteristicas
	    			->where('nome', $item->nome)
	    			->where('tipo', 'Empreendimento')
	    			->first();

	    		if (!$caracteristica) {
	    			$empreendimento->caracteristicas()->attach($model->id);	
	    		}
	    		
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de infraestruturas finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function itensLazer()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select(
				"SELECT a.*, b.id_empreendimento FROM site_itemlazer a
				INNER JOIN empreendimentos_itemlazer b 
				ON a.id_itemlazer = b.id_itemlazer
			");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	echo("Importando item lazer {$item->nome}") . "\n";

		    	$existe = Caracteristica::where('id_antigo', $item->id_itemlazer)
		    		->where('tipo', 'Lazer')
		    		->where('nome', $item->nome)
		    		->get()
		    		->first();

		    	$model = new Caracteristica();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}
		    	
	    		$model->nome = $item->nome;	    			    	
	    		$model->id_antigo = $item->id_itemlazer;
	    		$model->tipo = 'Lazer';
	    		$model->save();

	    		$empreendimento = Empreendimento::find($item->id_empreendimento);

	    		$caracteristica = $empreendimento
	    			->caracteristicas
	    			->where('nome', $item->nome)
	    			->where('tipo', 'Lazer')
	    			->first();

	    		if (!$caracteristica) {
	    			$empreendimento->caracteristicas()->attach($model->id);	
	    		}
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de itens de lazer finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function proximidades()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select("
				SELECT a.*, b.id_empreendimento FROM site_proximidades a
				INNER JOIN empreendimentos_proximidades b 
				ON a.id_proximidade = b.id_proximidade
			");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	echo("Importando proximidade {$item->nome}") . "\n";

		    	$existe = Caracteristica::where('id_antigo', $item->id_proximidade)
		    		->where('tipo', 'Proximidades')
		    		->where('nome', $item->nome)
		    		->get()
		    		->first();

		    	$model = new Caracteristica();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}
		    	
	    		$model->nome = $item->nome;
	    		$model->id_antigo = $item->id_proximidade;
	    		$model->tipo = 'Proximidades';
	    		$model->save();

	    		$empreendimento = Empreendimento::find($item->id_empreendimento);

	    		$caracteristica = $empreendimento
	    			->caracteristicas
	    			->where('nome', $item->nome)
	    			->where('tipo', 'Proximidades')
	    			->first();

	    		if (!$caracteristica) {
	    			$empreendimento->caracteristicas()->attach($model->id);	
	    		}
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de proximidades finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function plantas()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select("
				select * from empreendimentos_plantas
				where status = 'L'
			");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	echo("Importando plantas {$item->nome_planta}") . "\n";

		    	$empreendimento = Empreendimento::find($item->id_empreendimento);

		    	$existe = Planta::find($item->id_empreendimento_planta);

		    	$model = new Planta();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    		$suite = $this->getSuitesPlanta($model->empreendimento_id);
		    		
		    		if ($suite) {
						atribuir_caracteristica_manual($suite->minimo_suites, $model, 'Planta', 'qtd_suite');	
		    		}
		    	}
		    	
		    	// if (!$existe) {
	    		// 	$model->id = $item->id_empreendimento_planta;	    		
	    		// }

	    		//$model->construtora_id = $empreendimento->construtora_id;	    		
	    		//$model->empreendimento_id = $item->id_empreendimento;
	    		//$model->nome = $item->nome_planta;
	    		
	    		// if ($item->valor_inicial) {
	    		// 	$model->valor_inicial = $item->valor_inicial;	
	    		// }
	    		
	    		//$model->observacoes = $item->observacoes;
	    		//$model->status = $this->getStatus($item->status);
	    		//$model->area_privativa = $item->area_privativa_real;
	    		//$model->save();

	    // 		$caracteristicas = [
	    // 			'area_privativa_real',
	    // 			'qtd_dormitorio',
	    // 			'qtd_banheiro',
	    // 			'qtd_vaga',
	    // 		];

	    // 		$this->associarCaracteristicasGerais($caracteristicas, $model, 'Planta' , $item);

	    // 		if ($item->planta_tipo) {
	    // 			if ($item->planta_tipo == 1) {
	    // 				atribuir_caracteristica_manual('Casa Térrea', $model, 'Planta', 'planta_tipo');
	    // 			}

	    // 			if ($item->planta_tipo == 2) {
	    // 				atribuir_caracteristica_manual('Sala Comercial', $model, 'Planta', 'planta_tipo');
	    // 			}

	    // 			if ($item->planta_tipo == 3) {
	    // 				atribuir_caracteristica_manual('Duplex', $model, 'Planta', 'planta_tipo');
	    // 			}
	    // 		}	    		
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de plantas finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump( 'plantas', $e->getMessage());
		    exit();
		}
	}	

	public function getSuitesPlanta($empreendimento_id)
	{
		$suites = DB::connection('banco_lancamentos')->select("
			SELECT MIN(total_suites) AS minimo_suites, MAX(total_suites) AS maximo_suites FROM
			(SELECT COUNT(id_empreendimento_planta_dormitorio) AS total_suites
					FROM empreendimentos_plantas_dormitorios
					JOIN empreendimentos_plantas ON (empreendimentos_plantas_dormitorios.id_empreendimento_planta = empreendimentos_plantas.id_empreendimento_planta)
					WHERE empreendimentos_plantas.id_empreendimento = {$empreendimento_id} 
					AND empreendimentos_plantas_dormitorios.status = 'L' 
					AND empreendimentos_plantas_dormitorios.suite = 'Sim'
					GROUP BY empreendimentos_plantas_dormitorios.id_empreendimento_planta
			) AS total
		");

		$caracteristicas = [
			'minimo_suites',
			'maximo_suites'
		];

		$dados = [];

		if (isset($suites[0])) {
			$dados = $suites[0];
		}

		return $dados;
	}

	protected function associarCaracteristicasGerais($caracteristicas, $model, $tipo, $item, $exibir = 'Não')
	{
		if ($item) {
			foreach ($caracteristicas as $nome) {
				
				$caracteristica = Caracteristica::where('nome', $nome)->where('tipo', $tipo)->get()->first();

				if (!$caracteristica) {
					$caracteristica = new Caracteristica();
					$caracteristica->nome = $nome;
					$caracteristica->tipo = $tipo;
					$caracteristica->exibir = $exibir;
					$caracteristica->save();
				}

				if (isset($item->{$nome})) {					
					$model->caracteristicas()->attach($caracteristica, [
						'valor' => $item->{$nome}
					]);
				}

			}
		}
	}

	public function construtoras()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select('select * from construtoras');

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {
		    	echo("Importando construtora {$item->nome}") . "\n";

		    	$existe = Construtora::find($item->id_construtora);

		    	$model = new Construtora();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	if (!$existe) {
		    		$model->id = $item->id_construtora;
		    	}

		    	// $model->cnpj = $item->cnpj;
		    	// $model->ie = $item->inscricao_estadual;
		    	// $model->nome = $item->nome;
		    	// $model->nome_abreviado = $item->nome_abreviado;
		    	// $model->tempo_mercado = $item->tempo_mercado;
		    	// $model->observacoes = $item->observacoes;
		    	// $model->ano_fundacao = $this->getAnoFundacao($item->data_fundacao);
		    	// $model->status = $this->getStatus($item->status);
		    	// $model->email = $item->email_contato;
		    	// $model->telefone = $item->telefone;
		    	$model->save();

		    	//$this->baixarLogoConstrutora($model);

		    	// if ($item->endereco) {
		    	// 	$endereco = new Endereco();
		    	// 	$endereco->logradouro = $item->endereco;
		    	// 	$endereco->numero = $item->numero;
		    	// 	$endereco->complemento = $item->complemento;
		    		
		    	// 	if ($item->id_estado > 0) {
		    	// 		$endereco->estado_id = $item->id_estado;	
		    	// 	}

		    	// 	if ($item->id_cidade > 0) {		    		
		    	// 		$endereco->cidade_id = $item->id_cidade;
		    	// 	}

		    	// 	if ($item->id_bairro > 0) {
		    	// 		$endereco->bairro_id = $item->id_bairro;
		    	// 	}

		    	// 	$endereco->save();
		    	// 	$model->endereco_id = $endereco->id;
		    	// 	$model->save();
		    	// }
		    }

	    	DB::commit();
	   	
		   	echo('Importação construtoras finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function baixarLogoConstrutora($construtora)
	{
		try {
			$filename = "construtora-{$construtora->id}.png";
			$destino = "uploads/construtora/{$construtora->id}/original/";
			$origem = public_path("{$destino}{$filename}");

			if (!file_exists($origem)) {
				$url = "https://www.lancamentosonline.com.br/m/images/logo/{$filename}";			
				$destino = public_path($destino);

				if (!is_dir($destino)) {
					mkdir($destino, 0777, true);
					chmod($destino, 0777);
				}

				$this->download($url, $destino, $filename);	
				$construtora->gerarLogoTamanhos($construtora);		
			}			
		} catch (\Exception $e) {
			
		}		
	}

	protected function getAnoFundacao($data)
	{
		if ($data) {
			return (new \DateTime($data))->format('Y');
		}
	}

	public function quadras()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	select * from empreendimentos_torres a
		    	inner join empreendimentos b ON a.id_empreendimento = b.id_empreendimento
		    	where b.id_tipo = 3 or b.id_tipo = 4
		    	and a.status = 'L'
	    	");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {		    	   
		    	echo("Importando quadra {$item->nome_torre}") . "\n";

		    	$existe = Quadra::find($item->id_empreendimento_torre);

		    	$model = new Quadra();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	if (!$existe) {
		    		$model->id = $item->id_empreendimento_torre;
		    	}

		    	// $empreendimento = Empreendimento::find($item->id_empreendimento);
		    	// $construtora_id = $empreendimento->construtora_id;
		    	// $model->nome = $item->nome_torre;
		    	// $model->empreendimento_id = $item->id_empreendimento;
		    	// $model->construtora_id = $construtora_id;
		    	
		    	$model->previsao_entrega_mes = $item->mes_previsao_entrega;
		    	$model->previsao_entrega_ano = $item->ano_previsao_entrega;

		    	// $model->status = $this->getStatus($item->status);
		    	// $model->observacoes = $item->observacoes;
		    	$model->save();
		    }

	    	DB::commit();
	   	
		   	echo('Importação quadras finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function torres()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	select * from empreendimentos_torres a
		    	inner join empreendimentos b ON a.id_empreendimento = b.id_empreendimento
		    	where b.id_tipo = 1 or b.id_tipo = 2
		    	and a.status = 'L'
	    	");

		    DB::beginTransaction();

		    $etapas = [
		    	0 => 'Única',
		    	1 => 'Primeira',
		    	2 => 'Segunda',
		    	3 => 'Terceira',
		    	4 => 'Quarta',
		    	5 => 'Quinta',
		    	6 => 'Sexta',
		    	7 => 'Sétima',
		    ];

		    
		    foreach ($itens as $item) {		    	   
		    	echo("Importando torre {$item->nome_torre}") . "\n";

		    	$existe = Torre::find($item->id_empreendimento_torre);

		    	$model = new Torre();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	// $empreendimento = Empreendimento::find($item->id_empreendimento);
		    	// $construtora_id = $empreendimento->construtora_id;

		    	// if (!$existe) {
		    	// 	$model->id = $item->id_empreendimento_torre;
		    	// }

		    	// $model->nome = $item->nome_torre;
		    	// $model->empreendimento_id = $item->id_empreendimento;
		    	// $model->construtora_id = $construtora_id;

		    	// try {
		    	// 	$data = (new \DateTime("{$item->ano_previsao_entrega}-{$item->mes_previsao_entrega}-01"));
		    	// 	$model->previsao_entrega = $data->format('Y-m-d');
		    	// } catch (\Exception $e) {
		    	// 	// nao faz nada
		    	// }

		    	// $model->etapa = $etapas[$item->etapa];
		    	// $model->status = $this->getStatus($item->status);
		    	// $model->observacoes = $item->observacoes;
		    	$model->save();

		    	$this->caracteristicasTorre($item, $model);
		    }

	    	DB::commit();
	   	
		   	echo('Importação torres finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function caracteristicasTorre($item, $torre)
	{	
		$torre->previsao_entrega_mes = $item->mes_previsao_entrega;
		$torre->previsao_entrega_ano = $item->ano_previsao_entrega;
		$torre->save();

		atribuir_caracteristica_manual($item->apartamento_terreo, $torre, 'Torre', 'unidades_terreo');
		atribuir_caracteristica_manual($item->total_andar, $torre, 'Torre', 'andares');
		atribuir_caracteristica_manual($item->cobertura == 'Não' ? 'Não' : 'Sim', $torre, 'Torre', 'cobertura');
		atribuir_caracteristica_manual($item->unidade_andar, $torre, 'Torre', 'unidades_andar');
		atribuir_caracteristica_manual($item->qtd_elevador_social, $torre, 'Torre', 'elevador_social');
		atribuir_caracteristica_manual($item->qtd_elevador_servico, $torre, 'Torre', 'elevador_servico');
		atribuir_caracteristica_manual($item->nomeclatura_unidade, $torre, 'Torre', 'nomenclatura_unidades');
	}

	public function unidades()
	{
		try {	   
		  //   $itens = DB::connection('banco_lancamentos')->select("SELECT a.id_empreendimento_unidade, a.nomeclatura, a.andar, a.id_empreendimento_torre, a.id_empreendimento_planta, a.situacao, a.status, a.qtd_vaga_coberta, a.qtd_vaga_descoberta, c.id_empreendimento, c.id_construtora, a.metragem_total, a.tipo_sol, c.id_tipo, a.pne, d.coord_x, d.coord_y
	   //  		FROM empreendimentos_unidades a
				// INNER JOIN empreendimentos_torres b ON a.id_empreendimento_torre = b.id_empreendimento_torre
	   //  		INNER JOIN empreendimentos c ON b.id_empreendimento = c.id_empreendimento
	   //  		LEFT JOIN empreendimentos_unidades_coord d ON d.id_empreendimento_unidade = a.id_empreendimento_unidade
	   //  		WHERE a.status <> 'E' 
	   //  		AND a.status <> '' 
	   //  		AND c.status <> 'E'
	   //  		AND c.id_empreendimento > 253
	   //  		GROUP BY a.id_empreendimento_unidade
	   //  		ORDER BY c.id_empreendimento
    // 		");

		    $itens = DB::connection('banco_lancamentos')->select("SELECT a.id_empreendimento_unidade, a.nomeclatura, a.andar, a.id_empreendimento_torre, a.id_empreendimento_planta, a.situacao, a.status, a.qtd_vaga_coberta, a.qtd_vaga_descoberta, c.id_empreendimento, c.id_construtora, a.metragem_total, a.tipo_sol, c.id_tipo, a.pne
	    		FROM empreendimentos_unidades a
	    		INNER JOIN empreendimentos_torres b ON a.id_empreendimento_torre = b.id_empreendimento_torre
	    		INNER JOIN empreendimentos c ON b.id_empreendimento = c.id_empreendimento
	    		WHERE a.status <> 'E' 
	    		AND a.status <> '' 
	    		AND c.status <> 'E'
	    		AND c.id_empreendimento > 253
	    		GROUP BY a.id_empreendimento_unidade
	    		ORDER BY c.id_empreendimento
    		");

		    DB::beginTransaction();

		    $situacoes = [
		    	'D' => 'Disponível',
		    	'R' => 'Reservada',
		    	'V' => 'Vendida',
		    	'B' => 'Bloqueada',
		    	'O' => 'Outros'
		    ];
		    
		    foreach ($itens as $item) {	
				echo("Importando empreendimento -> {$item->id_empreendimento} -> unidade -> {$item->nomeclatura}") . "\n";

				$existe = Unidade::find($item->id_empreendimento_unidade);

				$model = new Unidade();
				
				if ($existe) {
					$model = $existe;
				}

				if (!$existe) {
					$model->id = $item->id_empreendimento_unidade;
				}

				$model->construtora_id = $item->id_construtora;
				$model->empreendimento_id = $item->id_empreendimento;
				
				$torre = Torre::find($item->id_empreendimento_torre);

				if (($item->id_tipo == 1 || $item->id_tipo == 2) && $torre) {
					$model->torre_id = $item->id_empreendimento_torre;	
				}

				$quadra = Quadra::find($item->id_empreendimento_torre);

				if (($item->id_tipo == 3 || $item->id_tipo == 4) && $quadra) {						
					$model->quadra_id = $item->id_empreendimento_torre;
				}
				
				$planta = Planta::find($item->id_empreendimento_planta);
				
				if ($planta) {
					$model->planta_id = $item->id_empreendimento_planta;
				}
				
				$model->andar_antigo = $item->andar;
				$model->nome = $item->nomeclatura;
				$model->situacao = isset($situacoes[$item->situacao]) ? $situacoes[$item->situacao] : 'Disponível';
				$model->status = $this->getStatus($item->status);
				// $model->coord_x = $item->coord_x;
				// $model->coord_y = $item->coord_y;
				$model->save();

				$caracteristicas = [
					'qtd_vaga_coberta',
					'qtd_vaga_descoberta',
					'metragem_total',
					'tipo_sol',
					'pne'
				];

				$this->associarCaracteristicasGerais($caracteristicas, $model, 'Unidade' , $item);
		    }

	    	DB::commit();
	   	
		   	echo('Importação unidades finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function dadosCondominio()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	SELECT * FROM dados_condominio_horizontal
    		");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {		    	   
		    	
	    		echo("Importando dados condominio horizontal {$item->id_empreendimento}") . "\n";

	    		$caracteristicasArray = [
	    			'tipo_condominio',
	    			'area_total',
	    			'area_verde',
	    			'total_unidades',
	    			'area_preservacao',
	    			'area_unidade_min',
	    			'area_unidade_max',
	    			'vagas_garagem',
	    			'previsao_entrega_mes',
					'previsao_entrega_ano',
					'valor_metro_centro',
					'valor_metro_esquina'
	    		];

	    		foreach ($caracteristicasArray as $c) {	    		

	    			$existe = Caracteristica::where('nome', $c)->where('tipo', 'Unidade')->get()->first();

	    			$model = new Caracteristica();
	    			
	    			if ($existe) {
	    				$model = $existe;
	    			}

	    			$model->nome = $c;
	    			$model->tipo = 'Unidade';
	    			$model->save();

	    			$empreendimento = Empreendimento::find($item->id_empreendimento);

	    			$empreendimento->caracteristicas()->attach($model->id, [
	    				'valor' => $item->{$c}
	    			]);
	    		}
		    }

	    	DB::commit();
	   	
		   	echo('Importação dados condominios horizontais finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function empreendimentos()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select('select * from empreendimentos');

		    DB::beginTransaction();

		    foreach ($itens as $item) {		    	   
		    	echo("Importando empreendimento {$item->nome}") . "\n";

		    	$existe = Empreendimento::find($item->id_empreendimento);

		    	$model = new Empreendimento();
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	if ($existe) {
		    		$model->id = $item->id_empreendimento;
			    	// $model->construtora_id = $item->id_construtora;	
			    	// $model->nome = $item->nome;
			    	// $model->descricao = $item->descricao;
			    	
			    	// if ($item->id_tipo == 1 or $item->id_tipo == 2) {
			    	// 	$model->tipo = 'Vertical';	
			    	// } else {
			    	// 	$model->tipo = 'Horizontal';	
			    	// }

			    	// if ($item->id_tipo) {
			    	// 	$model->subtipo_id = $item->id_tipo;	
			    	// }

			    	// if ($item->id_subtipo) {
		    		// 	$model->variacao_id = $item->id_subtipo;
		    		// }
		    		
			    	$model->valor_inicial = $item->valor_inicial;
			    	$model->valor_final = $item->valor_final;
			    	// $model->previsao_entrega = $this->getPrevisaoEntrega($item->previsao_entrega);
			    	// $model->latitude = $item->latitude; 
			    	// $model->longitude = $item->longitude; 
			    	// $model->logomarca = $this->getCaminhoLogomarca($item->id_empreendimento, $item->logomarca); 
			    	// $model->status = $this->getStatus($item->status);
			    	// $model->modalidade = $item->modalidade;
			    	// $model->selo_oferta = $item->selo_oferta;
			    	// $model->video = $item->video;
			    	// $model->logomarca = $item->logomarca;
			    	// $model->telefone_central = $item->telefone_central;
			    	$model->save();

			   //  	$this->associarEmpreendimentoEndereco($item, $model);

			   //  	$caracteristicas = [
			   //  		'previsao_condominio',
			   //  		'renda_familiar',
			   //  		'qtd_elevador',
			   //  		'video',
			   //  		'qtd_planta',
			   //  		'estacionamento_rotativo',
			   //  		'link_chat',
			   //  		'link_tour',
			   //  		'ocultar_valor',
			   //  		'selo_oferta',
			   //  		'mostra_mapa',
						// 'telefone_central',
						// 'tam_implantacao'
			   //  	];

			   //  	$this->associarCaracteristicasGerais($caracteristicas, $model, 'Empreendimento' , $item);
			   //  	$this->associarSuites($model);

			   //  	if ($item->logomarca) {
			   //  		$this->downloadLogoMarca($model->id, $item->logomarca);	
			   //  	}
		    	}		    	
		    }

	    	DB::commit();
	   	
		   	echo('Importação empreendimentos finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump('eemp', $e->getMessage(), $e->getTraceAsString());
		    exit();
		}
	}

	public function associarSuites($model)
	{
		$suites = DB::connection('banco_lancamentos')->select("
			SELECT MIN(total_suites) AS minimo_suites, MAX(total_suites) AS maximo_suites FROM
			(SELECT COUNT(id_empreendimento_planta_dormitorio) AS total_suites
					FROM empreendimentos_plantas_dormitorios
					JOIN empreendimentos_plantas ON (empreendimentos_plantas_dormitorios.id_empreendimento_planta = empreendimentos_plantas.id_empreendimento_planta)
					WHERE empreendimentos_plantas.id_empreendimento = {$model->id} 
					AND empreendimentos_plantas_dormitorios.status = 'L' 
					AND empreendimentos_plantas_dormitorios.suite = 'Sim'
					GROUP BY empreendimentos_plantas_dormitorios.id_empreendimento_planta
			) AS total
		");

		$caracteristicas = [
			'minimo_suites',
			'maximo_suites'
		];

		$dados = [];

		if (isset($suites[0])) {
			$dados = $suites[0];
		}

		$this->associarCaracteristicasGerais($caracteristicas, $model, 'Empreendimento' , $dados);
	}

	protected function associarEmpreendimentoEndereco($item, $model)
	{
		if ($item->endereco) {
			$endereco = new Endereco();
			$endereco->logradouro = $item->endereco;
			$endereco->numero = $item->numero;
			$endereco->estado_id = $item->id_estado;
			$endereco->cidade_id = $item->id_cidade;
			$endereco->bairro_id = $item->id_bairro;
			$endereco->save();
			$model->endereco_id = $endereco->id;
			$model->save();
		}
	}

	protected function getStatus($status)
	{
		$situacoes = [
			'B' => 'Bloqueada',
			'E' => 'Excluído',
			'L' => 'Liberada'
		];

		if (isset($situacoes[$status])) {
			return $situacoes[$status];
		}
	}

	protected function getEnum($opcao)
	{
		$opcoes = [
			'S' => 'Sim',
			'N' => 'Não'
		];

		if (isset($opcoes[$opcao])) {
			return $opcoes[$opcao];
		}
	}

	protected function downloadLogoMarca($empreendimento_id, $logomarca)
	{
		$url = "https://www.lancamentosonline.com.br/imagens/empreendimento/{$empreendimento_id}/arquivo/{$logomarca}";
		$destino = public_path("uploads/empreendimento/{$empreendimento_id}/arquivo/");

		if (!is_dir($destino)) {
			mkdir($destino, 0777, true);
			chmod($destino, 0777);
		}

		$this->download($url, $destino, $logomarca);
	}

	protected function getCaminhoLogomarca($id, $logomarca)
	{
		return "uploads/empreendimento/{$id}/arquivo/{$logomarca}";
	}

	protected function getPrevisaoEntrega($data)
	{
		if ($data) {
			$partes = explode('/', $data);
			$mesNome = $partes[0];
			$ano = $partes[1];
			$mes = $this->getMesNumero($mesNome);
			
			if ($mes && $ano) {
				return (new \DateTime("{$ano}-{$mes}-01"))->format('Y-m-d');
			}
		}
	}

	protected function getMesNumero($mesNome)
	{
		$mes = array(
		    'Janeiro' => '01',
		    'Fevereiro' => '02',
		    'Marco' => '03',
		    'Abril' => '04',
		    'Maio' => '05',
		    'Junho' => '06',
		    'Julho' => '07',
		    'Agosto' => '08',
		    'Novembro' => '09',
		    'Setembro' => '10',
		    'Outubro' => '11',
		    'Dezembro' => '12'
		);

		if (isset($mes[$mesNome])) {
			return $mes[$mesNome];
		}
	}

	public function usuarios()
	{
		try {
			
			$itens = DB::connection('banco_lancamentos')->select("select * from site_usuario");

			DB::beginTransaction();

		    foreach ($itens as $item) {
		    	if ($item->nome_site_usuario) {
			    	echo("Importando usuario {$item->nome_site_usuario}") . "\n";

			    	$existe = DB::table('usuarios')->where('email', $item->email_site_usuario)->first();

			    	$model = new Usuario();
			    	
			    	if ($existe) {
			    		$model = Usuario::where('email', $item->email_site_usuario)->get()->first();
			    	}
			    	
		    		$model->nome = $item->nome_site_usuario;
		    		$model->email = $item->email_site_usuario;
		    		$model->senha = bcrypt($item->senha_site_usuario);
		    		$model->telefone = $item->telefone_site_usuario;		    		
		    		$model->facebook_id = $item->id_facebook;
		    		$model->ultimo_login = $item->ultimo_login;
		    		$model->foto = $item->foto_site_usuario;
		    		$model->save();
		    	}
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de usuarios finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function fotos()
	{
		try {
			
			 $itens = DB::connection('banco_lancamentos')->select("
			 	select * from empreendimentos_fotos
			 	where status = 'L'
			 ");

			// $itens = DB::connection('banco_lancamentos')->select("
			// 	select * from empreendimentos_fotos a 
			// 	left join empreendimentos_fotos_coord b ON a.id_empreendimento_foto = b.id_empreendimento_foto
			// 	where status = 'L'
			// ");

			DB::beginTransaction();

		    foreach ($itens as $item) {		    	

		    	// if (!isset($item->coord_x)) {
		    	// 	continue;
		    	// }

		    	// if (!isset($item->coord_y)) {
		    	// 	continue;
		    	// }

		    	echo("Importando empreendimento: {$item->id_empreendimento} -> foto {$item->descricao}") . "\n";

		    	$model = new Foto();    

		    	$existe = Foto::find($item->id_empreendimento_foto);;
		    	
		    	if ($existe) {
		    		$model = $existe;
		    	}

		    	$empreendimento = Empreendimento::find($item->id_empreendimento);

		    	if (!$empreendimento) {
		    		continue;
		    	}

		    	if (!$existe) {
		    		$model->id = $item->id_empreendimento_foto;	
		    	}
		    	
	    		$model->construtora_id = $empreendimento->construtora_id;
	    		$model->empreendimento_id = $item->id_empreendimento;

	    		if ($item->id_planta > 0) {
	    			$planta = Planta::find($item->id_planta);
	    			if ($planta) {
	    				$model->planta_id = $item->id_planta;	
	    			}	
	    		}
	    		
    			$model->nome = $item->descricao;
    			$model->descricao = $item->descricao;
    			$model->arquivo = $item->arquivo;
    			$model->tipo = $this->getTipoImagem($item);
    			$model->destaque_carrossel = $item->destaque == 'S' ? 'Sim' : 'Não';
				$model->destaque_principal = $item->minidestaque == 'S' ? 'Sim' : 'Não';
				$model->status = $this->getStatus($item->status);
    			// $model->tipo_ponto = $item->tipo_ponto;
    			// $model->coord_x = $item->coord_x;
    			// $model->coord_y = $item->coord_y;
	    		$model->save();

    			//$this->baixarFoto($model);
		    }

	    	DB::commit();
	    	   	
		   	echo('Importação de fotos finalizada') . "\n";
	    	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function baixarFoto($foto)
	{
		if (!file_exists($foto->getCaminho())) {
			$url = "https://www.lancamentosonline.com.br/imagens/empreendimento/{$foto->empreendimento_id}/original/{$foto->arquivo}";
			
			$destino = public_path("uploads/empreendimento/{$foto->empreendimento_id}/original/");

			if (!is_dir($destino)) {
				mkdir($destino, 0777, true);
				chmod($destino, 0777);
			}

			$this->download($url, $destino, $foto->arquivo);
			$foto->adicionarMarcaDaAgua();
		}

		$foto->gerarFotoTamanhos();
	}

	public function download($url, $destino, $nome)
	{		 
		$downloadedFileContents = file_get_contents($url);
		
		if($downloadedFileContents === false) {
		    throw new Exception('Failed to download file at: ' . $url);
		}
		 
		$save = file_put_contents($destino . $nome, $downloadedFileContents);
		 
		if($save === false){
		    throw new Exception('Failed to save file to: ' , $fileName);
		}		
	}

	public function getTipoImagem($item)
	{
		$tipos = [
			'Plantas' => 'Geral',
			'Mapa (Implantação)' => 'Implantação',
			'Nova Foto' => 'Geral',
			'Imagens Internas' => 'Interna',
			'Imagens Externas' => 'Externa',
			'Decorado' => 'Decorado',
			'Estágio de Obra' => 'Estágio de Obra',
			'Implantação' => 'Implantação',
		];

		if (isset($tipos[$item->tipo_imagem])) {
			return $tipos[$item->tipo_imagem];
		}

		return 'Geral';
	}

	public function seoEmpreendimentos()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	SELECT seo.codigo_seo, seo.titulo_pagina_seo, seo.descricao_seo, seo.palavra_chave_seo, seo.h1_seo, seo.h2_seo, empreendimentos.valor_inicial, seo_empreendimento.id_empreendimento
		    	FROM seo 
		    	JOIN seo_empreendimento ON (seo.codigo_seo = seo_empreendimento.codigo_seo)
		    	JOIN empreendimentos ON seo_empreendimento.id_empreendimento = empreendimentos.id_empreendimento
		    	GROUP BY seo_empreendimento.id_empreendimento 
    		");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {		    	   
		    	
	    		echo("Importando seo empreendimento {$item->id_empreendimento}") . "\n";
	    			
	    		$existe = Seo::find($item->codigo_seo);

    			$model = new Seo();
    			
    			if ($existe) {
    				$model = $existe;
    			}

    			if (!$existe) {
    				$model->id = $item->codigo_seo;
    			}	

    			$model->titulo = $item->titulo_pagina_seo;
    			$model->descricao = $item->descricao_seo;
    			$model->palavra_chave = $item->palavra_chave_seo;
    			$model->h1 = $item->h1_seo;
    			$model->h2 = $item->h2_seo;
    			$model->save();

    			$empreendimento = Empreendimento::find($item->id_empreendimento);
    			$empreendimento->seo_id = $model->id;
    			$empreendimento->save();
		    }

	    	DB::commit();
	   	
		   	echo('Importação seo empreendimentos finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}
	
	public function contatosConstrutora()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	SELECT * FROM contato_construtora
		    	ORDER BY id_construtora
	    	");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {		    	   
		    	
	    		echo("Importando contatos da construtora {$item->id_construtora}") . "\n";
	    			
	    		$existe = ContatoConstrutora::find($item->codigo_contato_construtora);

    			$model = new ContatoConstrutora();
    			
    			if ($existe) {
    				$model = $existe;
    			}

    			if (!$existe) {
    				$model->id = $item->codigo_contato_construtora;
    			}	

    			$model->construtora_id = $item->id_construtora;
    			$model->nome = $item->nome_contato_construtora;
    			$model->email = $item->email_contato_construtora;
    			$model->telefone = $item->telefone_contato_construtora;
    			$model->situacao = $this->getStatus($item->situacao_contato_construtora);
    			$model->recebe_relatorio = $this->getEnum($item->recebe_relatorio);
    			$model->save();    			
		    }

	    	DB::commit();
	   	
		   	echo('Importação contatos da construtora finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function atribuirAndares()
	{
		try {	   
		    $unidades = Unidade::where('andar_antigo', '<>', '')->where('torre_id', '<>', '')->get()->all();

		    DB::beginTransaction();
		    
		    foreach ($unidades as $unidade) {		    	   
		    	
	    		echo("atribuindo andar unidade {$unidade->nome}") . "\n";	    		

	    		$andar = Andar::where('numero', $unidade->andar_antigo)
	    			->where('torre_id', $unidade->torre_id)
	    			->get()
	    			->first();

	    		if (!$andar) {
	    			echo("torre -> {$unidade->torre_id} -> andar {$unidade->andar_antigo}") . "\n";	    		
	    			$andar = new Andar();
	    			$andar->construtora_id = $unidade->construtora_id;
	    			$andar->torre_id = $unidade->torre_id;
	    			$andar->numero = $unidade->andar_antigo;
	    			$andar->save();
	    		}

    			$unidade->andar_id = $andar->id;
    			$unidade->save();	
		    }

	    	DB::commit();
	   	
		   	echo('Andares atribuidos as unidades') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function noticias()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
		    	SELECT * FROM noticias
    		");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {
		    	
	    		echo("Importando noticias {$item->id_noticia}") . "\n";
	    			
	    		$existe = Noticia::find($item->id_noticia);

    			$model = new Noticia();
    			
    			if ($existe) {
    				$model = $existe;
    			}

    			if (!$existe) {
    				$model->id = $item->id_noticia;
    			}	

				$model->titulo = $item->titulo;
				$model->data = $item->data;
				$model->arquivo = $item->arquivo;
				$model->texto = $item->texto;
				$model->status = $this->getStatus($item->status);
				$model->resumo = $item->resumo;
				$model->fonte = $item->fonte;
    			$model->save();    			
		    }

	    	DB::commit();
	   	
		   	echo('Importação noticias finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function leads()
	{
		try {	   
		    $itens = DB::connection('banco_lancamentos')->select("
				SELECT * FROM atendimento
				WHERE id_empreendimento IS NOT NULL
    		");

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {
		    	
	    		echo("Importando leads {$item->codigo_atendimento}") . "\n";
	    			
	    		$existe = Lead::find($item->codigo_atendimento);

    			$model = new Lead();
    			
    			if ($existe) {
    				$model = $existe;
    			}

    			if (!$existe) {
    				$model->id = $item->codigo_atendimento;
				}	
				
				$empreendimento = Empreendimento::find($item->id_empreendimento);

				if ($empreendimento) {					

					$model->empreendimento_id = $empreendimento->id;
					$model->construtora_id = $empreendimento->construtora->id;
					$model->nome = utf8_decode($item->nome_atendimento);
					$model->telefone = utf8_decode($item->telefone_atendimento);
					$model->email = utf8_decode($item->email_atendimento);
					$model->previsao = utf8_decode($item->previsao_compra);
					$model->interesse = utf8_decode($item->interesse);
					$model->renda = utf8_decode($item->renda);
					$model->mensagem = utf8_decode($item->solicitacao_atendimento);
					$model->dispositivo = utf8_decode($item->dispositivo);
					$model->origem = utf8_decode($item->origem);
					$model->tempo = utf8_decode($item->tempo_site);
					$model->save();
				}				
		    }

	    	DB::commit();
	   	
		   	echo('Importação leads finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function gerarPerfilEmpreendimento()
	{
		$empreendimentos = Empreendimento::all();
		$perfil = (new EmpreendimentoPerfil());

		foreach ($empreendimentos as $empreendimento) {
			$perfil->gerar($empreendimento->id);
		}
	}

	public function gerarPerfilConstrutora()
	{
		$construtoras = Construtora::all();
		$perfil = (new ConstrutoraPerfil());

		foreach ($construtoras as $construtora) {
			$perfil->gerar($construtora->id);
		}
	}

	public function cadastrarUsuarioConstrutora()
	{
		try {	   
		    $itens = ContatoConstrutora::where('situacao', 'Liberada')->get();

			DB::beginTransaction();
			
			$role = Role::where('name', 'Padrão')->get()->first();
		    
		    foreach ($itens as $item) {
				
				$construtora = Construtora::find($item->construtora->id);

	    		echo("Importando usuario da construtora {$construtora->nome_abreviado} -> {$item->email}") . "\n";
	    			
	    		$existe = BackpackUser::where('email', $item->email)->get()->first();

    			$model = new BackpackUser();
    			
    			if ($existe) {
    				$model = $existe;
    			}
				
				if ($construtora) {
					$model->construtora_id = $item->construtora_id;
					$model->name = $item->nome;
					$model->email = $item->email;
					$model->telefone_fixo = $item->telefone;
					$model->whatsapp = $item->telefone;
					$model->celular = $item->telefone;
					$model->status = 'Ativo';
					$model->recebe_relatorio = $item->recebe_relatorio;
					$model->password = \bcrypt('lancamentos2019');
					$model->save();

					if (!$model->getPerfil()) {
						$model->roles()->attach($role->id);
					}

					(new UserPerfil())->gerar($model->id);
				}				
		    }

	    	DB::commit();
	   	
		   	echo('Importação usuários da construtora finalizada') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function gerarLogosConstrutoras()
	{
		try {	   
		    $itens = Construtora::all();

		    DB::beginTransaction();
		    
		    foreach ($itens as $item) {
		    	echo("Importando construtora {$item->nome}") . "\n";
		    	try {
		    		$item->gerarLogoTamanhos($item);	
		    	} catch (\Exception $e) {
		    		
		    	}		    	
		    }

	    	DB::commit();
	   	
		   	echo('Logos construtoras geradas') . "\n";
	    
		} catch (\Exception $e) {
		    DB::rollback();
		    echo '<pre>';
		    var_dump($e->getMessage());
		    exit();
		}
	}

	public function importarCaracteristicasPlantas()
	{
		$itens = DB::connection('banco_lancamentos')->select("
	    	SELECT * FROM empreendimentos_plantas_item a
	    	INNER JOIN site_plantas_item b ON a.id_planta_item = b.id_planta_item
	    	WHERE a.status = 'L'
	    	AND b.status = 'L'
		");

	    DB::beginTransaction();
		    
	    foreach ($itens as $item) {	    	
    		echo("Importando caracteristica {$item->nome}") . "\n";    		

    		$model = Planta::find($item->id_empreendimento_planta);

    		if ($model) {
    			$caracteristicas = [$item->nome];
    			$this->associarCaracteristicasPlanta($caracteristicas, $model, 'Planta');	
    		}
    	}

    	DB::commit();

	}

	protected function associarCaracteristicasPlanta($caracteristicas, $model, $tipo)
	{		
		foreach ($caracteristicas as $nome) {			
			$caracteristica = Caracteristica::where('nome', $nome)->where('tipo', $tipo)->get()->first();

			if (!$caracteristica) {
				$caracteristica = new Caracteristica();
				$caracteristica->nome = $nome;
				$caracteristica->tipo = $tipo;
				$caracteristica->exibir = 'Sim';
				$caracteristica->save();
			}
			
			$model->caracteristicas()->attach($caracteristica);
		}
	}

	protected function setarIdFotosPlantas()
	{
		$plantas = Planta::all();

		foreach ($plantas as $planta) {
			$fotos = $planta->fotos;
			
			if ($fotos) {
				foreach ($fotos as $k => $foto) {
					if ($k == 0) {
						echo "Importando Foto PLANTA" . "\n";
						$planta->foto_planta = $foto->id;
					}

					if ($k == 1) {
						echo "Importando FOTO Primeira PLANTA" . "\n";
						$planta->foto_primeira_planta = $foto->id;
					}

					if ($k == 2) {
						echo "Importando FOTO Segunda PLANTA" . "\n";
						$planta->foto_segunda_planta = $foto->id;
					}

					if ($k == 3) {
						echo "Importando FOTO Terceira PLANTA" . "\n";
						$planta->foto_terceira_planta = $foto->id;
					}

					$planta->save();
				}
			}			
		}
	}	

	protected function salvarLatitudeLongitudeEndereco()
	{
		$empreendimentos = Empreendimento::all();

		foreach ($empreendimentos as $empreendimento) {
			$endereco = $empreendimento->endereco;
			if ($endereco) {
				echo "{$empreendimento->nome} - Atualizando latitude longitude" . "\n";
				$endereco->latitude = $empreendimento->latitude;
				$endereco->longitude = $empreendimento->longitude;
				$endereco->save();
			}			
		}
	}

	protected function setarAreaPrivativaPlantas()
	{
		$empreendimentos = Empreendimento::all();

		foreach ($empreendimentos as $empreendimento) {						
			$plantas = $empreendimento->plantas;
			foreach ($plantas as $planta) {
				$area_privativa = $planta->caracteristicas->where('nome', 'area_privativa_real')->first();
				if ($area_privativa) {
					echo "{$empreendimento->nome} - Atualizado area privativa - {$area_privativa->pivot->valor}" . "\n";
					$planta->area_privativa = $area_privativa->pivot->valor;
					$planta->save();
				}
			}
		}
	}

	protected function corrigirConstrutoraIdQuadras()
	{
		$quadras = Quadra::all();

		foreach ($quadras as $quadra) {						
			$empreendimento = $quadra->empreendimento;

			echo "ANTERIOR -> {$quadra->construtora_id} -> ATUAL -> {$empreendimento->construtora_id}" . "\n";

			$quadra->construtora_id = $empreendimento->construtora_id;
			$quadra->save();			

			$unidades = $quadra->unidades;

			if ($unidades) {
				foreach ($unidades as $unidade) {
					$unidade->construtora_id = $empreendimento->construtora_id;
					$unidade->save();
				}
			}
		}
	}
	
	public function corrigirFotosPlantas()
	{
		$fotos = Foto::where('planta_id', '<>', null)->get();

		foreach ($fotos as $foto) {
			echo "Foto -> {$foto->id}" . "\n";

			$planta = Planta::find($foto->planta_id);

			if ($planta) {
				if ($planta->foto_planta) {
					
					$f = Foto::find($planta->foto_planta);

					if (!$f) {
						$planta->foto_planta = $foto->id;
						$planta->save();
					}
				}
			}
		}
	}

	public function corrigirValorUnidades()
	{
		$unidades = Unidade::join('caracteristicas_unidades', 'caracteristicas_unidades.unidade_id', '=', 'unidades.id')->where('caracteristicas_unidades.caracteristica_id', 467)->get();

		foreach ($unidades as $unidade) {
				
			$c = $unidade->caracteristicas->where('nome', 'valor_unidade')->first();

			if ($c) {
				$valor = $c->pivot->valor;

				if (strpos($valor, ',') !== false) {
					echo 'VALOR BR ->>>' . $valor . "\n";
					$valor = converte_reais_to_mysql($valor);
					echo 'VALOR AMERICANO ->>>' . $valor . "\n";
					atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'valor_unidade');
				}
			}
		}
	}

	public function corrigirValorMetragem()
	{
		$unidades = Unidade::join('caracteristicas_unidades', 'caracteristicas_unidades.unidade_id', '=', 'unidades.id')->offset(30000)->limit(10000)->where('caracteristicas_unidades.caracteristica_id', 313)->get();

		foreach ($unidades as $unidade) {
				
			$c = $unidade->caracteristicas->where('nome', 'metragem_total')->first();

			if ($c) {
				$valor = $c->pivot->valor;

				echo 'METRAGEM BR ->>>' . $valor . "\n";

				if (strpos($valor, ',') !== false) {					
					$valor = converte_reais_to_mysql($valor);
					echo 'METRAGEM AMERICANO ->>>' . $valor . "\n";
					atribuir_caracteristica_manual($valor, $unidade, 'Unidade', 'metragem_total');
				}
			}
		}
	}

	public function setarConstrutoraIdToCompradores()
	{
		$compradores = CompradorUnidade::all();

		foreach ($compradores as $c) {			
			$un = Unidade::find($c->unidade_id);

			if ($un) {
				echo 'Construtora ID ->>> ' . $un->construtora_id . "\n";
				$c->construtora_id = $un->construtora_id;
				$c->empreendimento_id = $un->empreendimento_id;
				$c->save();
			}
		}
	}

	public function importarCaracteristicasUnidades()
	{
		$caracteristicas = DB::connection("banco_lancamentos")->select("
			SELECT caracteristicas_unidades.*, unidades.empreendimento_id 
			FROM caracteristicas_unidades
			JOIN unidades ON caracteristicas_unidades.unidade_id = unidades.id
			WHERE unidades.construtora_id = 31 AND caracteristicas_unidades.caracteristica_id = 467 LIMIT 10
		");
		DB::beginTransaction();
		foreach ($caracteristicas as $c) {	
			echo $c->unidade_id."\n";		
			$un = Unidade::find($c->unidade_id);
			$caracteristica = Caracteristica::find($c->caracteristica_id);

			$un->caracteristicas()->detach($caracteristica->id);           
            $un->caracteristicas()->attach($caracteristica, [
                'valor' => $c->valor
			]);
		}
		DB::commit();
	}
}
