<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Mail;
use App\Mail\Safe2Pay\Cobranca as EmailCobranca;
use \DB;

use Safe2Pay\API\PaymentRequest;
use Safe2Pay\Models\Core\Config as Enviroment;
use Safe2Pay\Models\General\Address;
use Safe2Pay\Models\General\Customer;
use Safe2Pay\Models\General\Product;
use Safe2Pay\Models\Payment\BankSlip;
use Safe2Pay\Models\Transactions\Transaction;
use Safe2Pay\Models\Core\Client;
use Safe2Pay\API\InvoiceRequest;
use Safe2Pay\Models\SingleSale\SingleSale;
use Safe2Pay\Models\SingleSale\SingleSaleProduct;
use Safe2Pay\Models\SingleSale\SingleSalePaymentMethod;

class LancamentoFinanceiro extends Model
{
	use SoftDeletes;

	/*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'lancamentos_financeiros';
	protected $fillable = [
		'nome',
		'lancamento_recorrente_id',
		'valor',
		'vencimento',
		'url',
		'gerar_nf',
		'observacoes'
	];

	protected $parametros = [];
	protected $construtoraLan;
	protected $venda;

	/*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/	

	public function setApiKey()
	{
		$enviroment = new Enviroment();
		$api_key = config('app.sandbox') == 'sim'
		? 'C9F83453F9ED4A008BD10695BEC529A7'
		: '0E2E22E3482A4C3E89D35DB0F5744886';

		$enviroment->setAPIKEY($api_key);
	}

	public function getCliente()
	{
		$cliente = new Customer();
		$cliente->setName($this->construtoraLan->getConstrutoraNome());
		$cliente->setIdentity($this->construtoraLan->cnpj);
		$cliente->setEmail($this->construtoraLan->email);
		$cliente->setPhone($this->construtoraLan->telefone);

		$cliente->Address = new Address();
		$cliente->Address->setZipCode($this->construtoraLan->endereco->cep);
		$cliente->Address->setStreet($this->construtoraLan->endereco->logradouro);
		$cliente->Address->setNumber($this->construtoraLan->endereco->numero);
		$cliente->Address->setComplement($this->construtoraLan->endereco->complemento);
		$cliente->Address->setDistrict($this->construtoraLan->endereco->cidade->nome);
		$cliente->Address->setStateInitials($this->construtoraLan->endereco->estado->uf);
		$cliente->Address->setCityName($this->construtoraLan->endereco->cidade->nome);
		$cliente->Address->setCountryName("Brasil");

		return $cliente;
	}

	public function criarLancamentoFinanceiro(array $parametros)
	{	
		DB::beginTransaction();

		$this->parametros = $parametros;
		$this->parametros['referencia'] = uniqid();
		$this->construtoraLan = $parametros['construtora'];
		
		$validacao = $this->validacoesGerarLancamento();

		if ($validacao) {
			return [
				'erro' => true,
				'retorno' => $validacao
			];
		}

		$this->setApiKey();

		$this->venda = new SingleSale();
        $this->venda->setCustomer($this->getCliente());
        $this->setarFormasPagamento();
        $this->setarProdutos();
        $this->setarInformacoesVenda();
     	$response  = InvoiceRequest::Add($this->venda);
		
		$validacaoRetorno = $this->validarRetorno($response);

		if ($validacaoRetorno) {
			return $validacaoRetorno;
		}

		$this->parametros['url'] = $response->ResponseDetail['SingleSaleUrl'];
		$this->parametros['transacao_id'] = $response->ResponseDetail['SingleSaleHash'];
		$this->parametros['construtora_id'] = $this->construtoraLan->id;
		$this->registrarLancamento();

		DB::commit();

		if ($this->parametros['enviar_email'] == 'Sim') {
			$this->enviarPorEmail();
		}

		return [
			'erro' => false,
			'retorno' => 'Lançamento Financeiro Criado com Sucesso'
		];
	}

	public function enviarPorEmail()
	{
		$destinatarios = [];

		if (config('app.ambiente') == 'producao') {		    
		    $destinatarios[] = 'edson@lancamentosonline.com.br';
		}

		if ($this->construtora->contatos()->first()) {
			
			foreach ($this->construtora->contatos as $contato) {
				$destinatarios[] = $contato['email'];	
			}
		}

		if ($destinatarios) {
			Mail::to($destinatarios)->send(new EmailCobranca($this));	
		}		
	}

	public function setarInformacoesVenda()
	{
		$this->venda->setCallbackUrl($this->getUrlRetorno());
		$this->venda->setDueDate($this->parametros['vencimento']);
		$this->venda->setReference($this->parametros['referencia']);
		$this->venda->setPenaltyAmount("1.00");
		$this->venda->setInterestAmount("0.033");
	}

	public function getUrlRetorno()
	{
		return "https://lancamentosonline.com.br/retorno-safepay";
	}

	public function setarFormasPagamento()
	{
		/*
			1 - Boleto
			2 - Cartão de crédito
			3 - Criptomoedas
			4 - Cartão de débito
		*/

		$this->venda->setPaymentMethods(
		    (array(
		        new SingleSalePaymentMethod("1"),
		        new SingleSalePaymentMethod("2"),
		        new SingleSalePaymentMethod("4"),
		    ))
		);
	}

	public function setarProdutos()
	{
		$this->venda->setProducts(
		    ([
		        new SingleSaleProduct(
		        	1, 
		        	"Portal Lançamentos Online", 
		        	converte_reais_to_mysql($this->parametros['valor']),
		        	"1"
		        ),
		    ])
		);
	}

	public function validacoesGerarLancamento()
	{
		if (!$this->construtoraLan->endereco) {
			return 'Construtora não possui endereço cadastrado';
		}
	}

	public function validarRetorno($response)
	{
		if ($response->HasError) {
			return [
				'erro' => true,
				'retorno' => $response->Error
			];
		}
	}

	public function registrarLancamento()
	{		
		$lancamento = $this;
		$lancamento->nome = $this->getTituloLancamento();
		$lancamento->construtora_id = $this->construtoraLan->id;
		$lancamento->valor = $this->parametros['valor'];
		$lancamento->vencimento = $this->parametros['vencimento'];
		$lancamento->url = $this->parametros['url'];
		$lancamento->observacoes = $this->parametros['observacoes'];
		$lancamento->gerar_nf = $this->parametros['gerar_nf'];
		$lancamento->transacao_id = $this->parametros['transacao_id'];
		$lancamento->referencia = $this->parametros['referencia'];
		$lancamento->enviar_email = $this->parametros['enviar_email'];
		$lancamento->save();

		if ($this->parametros['tipo_cobranca'] == 'Recorrente') {
			$id = (new LancamentoFinanceiroRecorrente())->registrar($this->parametros);
			$lancamento->lancamento_financeiro_recorrente_id = $id;
			$lancamento->save();
		}
	}

	public function getTituloLancamento()
	{
		return $this->construtoraLan->getConstrutoraNome();
	}

	public function retornoSafePay($request)
	{
		if ($request->isMethod('post')) {
			$json = file_get_contents('php://input');
		    $object = json_decode($json);

		    if (json_last_error() !== JSON_ERROR_NONE) {
		        die(header('HTTP/1.0 415 Unsupported Media Type'));
		    }

		    $this->tratarRetorno($object);

		    $adms = [];
		    $adms[] = 'edson@lancamentosonline.com.br';
		    $adms[] = 'erickleandrolima@gmail.com';

		    Mail::send('emails.safe2pay.retorno', ['json' => $object], function ($m) use ($adms, $object) {
                $m->from('web@lancamentosonline.com.br', 'Lançamentos Online');
            	$m->to($adms);
            	$m->subject("Retorno Safe2Pay - {$object->IdTransaction} - {$object->TransactionStatus->Name}");
            });			
		}
	}

	public function tratarRetorno($retorno)
	{
		$referencia = $retorno->Reference;

		$lancamento = LancamentoFinanceiro::where('referencia', $referencia)->first();

		if ($lancamento) {
			$status = $retorno->TransactionStatus->Id;

			if ($status == 3) {
				$lancamento->situacao = 'Pago';
				$lancamento->save();
			}
		}
	}

	public function cancelarLancamentoFinanceiro($transacao_id)
	{
		$lancamento = $this->transacaoId($transacao_id)->get()->first();		

		if (!$lancamento) {
			return [
				'erro' => false,
				'retorno' => 'Lançamento não encontrado'
			];
		}

		DB::beginTransaction();

		$this->setApiKey();

       	$response  = InvoiceRequest::Cancel($transacao_id);

		$validacaoRetorno = $this->validarRetorno($response);

		if ($validacaoRetorno) {
			return $validacaoRetorno;
		}		

		$lancamento->situacao = 'Cancelado';
		$lancamento->save();

		$recorrente = $lancamento->recorrente;

		if ($recorrente) {
			$recorrente->situacao = 'Cancelado';
			$recorrente->save();
		}

		DB::commit();

		return [
			'erro' => false,
			'retorno' => 'Lançamento Financeiro Cancelado com Sucesso'
		];       	
	}

	public function scopeTransacaoId($query, $transacao_id)
	{
		return $query->where('transacao_id', $transacao_id);
	}

	/*
	|--------------------------------------------------------------------------
	| RELATIONS
	|--------------------------------------------------------------------------
	*/

	public function construtora()
	{
		return $this->belongsTo('App\Models\Construtora');
	}

	public function recorrente()
	{
		return $this->belongsTo('App\Models\LancamentoFinanceiroRecorrente', 'lancamento_financeiro_recorrente_id');
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/

	/*
	|--------------------------------------------------------------------------
	| ACCESORS
	|--------------------------------------------------------------------------
	*/

	public function getValorAttribute($valor)
	{
	    if ($valor) {
	        return number_format($valor, 2, ',', '.');
	    }
	}

	public function getVencimentoAttribute($valor)
	{
	    if ($valor && (new \DateTime($valor))) {
	        return (new \DateTime($valor))->format('d/m/Y');
	    }
	}

	/*
	|--------------------------------------------------------------------------
	| MUTATORS
	|--------------------------------------------------------------------------
	*/

	public function setValorAttribute($valor)
	{        
	    $this->attributes['valor'] = converte_reais_to_mysql($valor);
	}
}
