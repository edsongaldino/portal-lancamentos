<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\ConstrutoraRequest as StoreRequest;
use App\Http\Requests\ConstrutoraRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Modalidade;
use App\Models\Tipoconstrutora;
use App\Models\Assinatura;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\Email;
use App\Models\Construtora;
use App\Models\Bairro;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Class ConstrutoraCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ConstrutoraCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Construtora');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/construtora');
        $this->crud->setEntityNameStrings('construtora', 'construtoras');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns

        $this->crud->setColumns(['nome', 'cnpj', 'ano_fundacao']);

        $this->crud->addColumn([
            'name' => 'ano_fundacao',
            'label' => "Fundação"
        ]);

        $this->crud->addColumn([
            'name' => 'cnpj',
            'label' => "CNPJ"
        ]);

        $this->crud->addField([
            'name' => 'nome',
            'label' => "Nome da construtora",
            'type' => 'text',
            'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
            'name' => 'nome_abreviado',
            'label' => "Nome Abreviado",
            'type' => 'text',
            'tab' => 'Dados da construtora',
        ]);        

        $this->crud->addField([
            'name' => 'cnpj',
            'label' => "CNPJ",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-8'
            ],
            'attributes' => ['class' => 'cnpj form-control'],
            'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
            'name' => 'ano_fundacao',
            'label' => "Fundação",
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ],
            'attributes' => ['maxlength' => '4'],
            'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
           'label' => "Tipo",
           'type' => 'select2_multiple',
           'name' => 'tipoconstrutora',
           'entity' =>'tipoconstrutora',
           'attribute' => 'nome',
           'model' => 'App\Models\Tipoconstrutora',
           'pivot' => true,
           'wrapperAttributes' => [
               'class' => 'form-group col-md-6'
           ],
           'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
           'label' => "Modalidade",
           'type' => 'select2_multiple',
           'name' => 'modalidades',
           'entity' =>'modalidade',
           'attribute' => 'nome',
           'model' => 'App\Models\Modalidade',
           'pivot' => true,
           'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
           'label' => "Situação",
           'type' => 'enum',
           'name' => 'status',
           'tab' => 'Dados da construtora',
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'acesso_domus',
            'label' => "Acesso Domus",
            'type' => 'enum',
            'tab' => 'Dados da construtora',
            'wrapperAttributes' => [
                 'class' => 'col-md-6'
             ]
        ]);

        $this->crud->addField([
            'name' => 'logradouro',
            'label' => 'Logradouro',
            'type' => 'text',            
            'tab' => 'Endereço'
        ]);

        $this->crud->addField([
            'name' => 'complemento',
            'label' => 'Complemento',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-8',                
            ],
            'tab' => 'Endereço'
        ]);

        $this->crud->addField([
            'name' => 'numero',
            'label' => 'Nº',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
            'tab' => 'Endereço'
        ]);

        $this->crud->addField([
           'label' => "Estado",
           'type' => 'select_from_array',
           'name' => 'estado_id',
           'attributes' => ['id' => 'estado'],
           'allows_null' => true,
           'placeholder' => 'Selecione o estado',           
           'options' => Estado::get()->pluck('nome', 'id')->toArray(),
           'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'tab' => 'Endereço',
        ]);

        $this->crud->addField([
           'label' => "Cidade",
           'type' => 'cidade',
           'name' => 'cidade_id',
           'allows_null' => true,
           'placeholder' => 'Selecione o estado',
           'options' => Cidade::get()->pluck('nome', 'id')->toArray(),
           'attributes' => ['id' => 'cidade_id'],
           'wrapperAttributes' => [
               'class' => 'form-group col-md-6',
               'id' => 'cidade-wrapper'
           ],
           'tab' => 'Endereço',
        ]);

        $this->crud->addField([
            'name' => 'bairro_id',
            'label' => 'Bairro',
            'type' => 'bairro',
            'attributes' => [
              'placeholder' => 'Selecione a cidade',
              'readonly' => true,
            ],
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6',
                'id'    => 'bairro-wrapper' 
            ],
            'tab' => 'Endereço',
            'options' => Bairro::get()->pluck('nome', 'id')->toArray(),
        ]);

        $this->crud->addField([
            'name' => 'cep',
            'label' => 'Cep',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
            'attributes' => ['class' => 'form-control cep'],
            'tab' => 'Endereço'
        ]);

        $this->crud->addField([ // select_from_array
            'name' => 'emails',
            'label' => 'Informe no mínimo 1 e-mail',
            'type' => 'table',
            'entity_singular' => 'E-mail', // used on the "Add X" button
            'columns' => [
                'email' => 'E-mail'
            ],            
            'min' => 1, // minimum rows allowed in the table,
            'tab' => 'E-mail',
            'store_as_json' => false
        ]);

        $this->crud->addField([
            'name' => 'telefones',
            'label' => 'Telefone',
            'type' => 'telefone',
            'options' => [
              'Fixo' => 'Fixo', 
              'Celular' => 'Celular', 
              'WhatsApp' => 'WhatsApp'
            ],
            'tab' => 'Telefone'
        ]);

        $this->crud->addField([
           'label' => "Valor mensal",
           'type' => 'text',
           'name' => 'valor_mensal',           
           'tab' => 'Assinatura',
           'attributes' => [
            'class' => 'form-control moeda',
           ],
           'wrapperAttributes' => [
            'class' => 'form-group col-md-6'
           ]
        ]);        

        $this->crud->addField([
           'label' => "Plano de Assinatura",
           'type' => 'select2_from_array',
           'name' => 'assinatura_id',
           'options' => Assinatura::get()->pluck('nome', 'id')->toArray(),
           'tab' => 'Assinatura',
           'wrapperAttributes' => [
            'class' => 'form-group col-md-6'
           ]
        ]);

        $this->crud->addField([
            'name' => 'contatos',
            'label' => 'Contatos',
            'type' => 'contato',            
            'tab' => 'Contatos'
        ]);

        $this->crud->addField([
            'name' => 'logo',
            'label' => 'Logo da construtora',
            'type' => 'image',
            'crop' => true,
            'upload' => true,
            'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
           'type' => 'view',
           'name' => 'ajax-estado',
           'view' => 'backpack::crud.partials.ajax_estado',
           'tab' => 'Dados da construtora',
        ]);

        $this->crud->addField([
           'type' => 'view',
           'name' => 'ajax-cidade',
           'view' => 'backpack::crud.partials.ajax_cidade',
           'tab' => 'Dados da construtora',
        ]);        

        // add asterisk for fields that are required in ConstrutoraRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');        
    }

    public function store(StoreRequest $request)
    {
  		DB::beginTransaction();
      
      	$redirect_location = parent::storeCrud($request);

      	(new Construtora())->cadastrarRelacionamentos($request, $this->crud->entry->id);

      	DB::commit();

      	return $redirect_location;
    }

    public function edit($id)
    {      
        $this->crud->hasAccessOrFail('update');
        $this->crud->setOperation('update');

        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        // get the info for that entry
        $this->data['entry'] = $this->crud->getEntry($id);
        $this->data['crud'] = $this->crud;
        $this->data['saveAction'] = $this->getSaveAction();
        $this->data['fields'] = $this->crud->getUpdateFields($id);
        $this->data['title'] = $this->crud->getTitle() ?? trans('backpack::crud.edit').' '.$this->crud->entity_name;

        $this->data['id'] = $id;

        $this->getRelacionamentos($id);

        // load the view from /resources/views/vendor/backpack/crud/ if it exists, otherwise load the one in the package
        return view($this->crud->getEditView(), $this->data);
    }


    private function getRelacionamentos($id)
    {
	  	$dados = [];
	  	$dadosEndereco = [];
	  	$dadosAssinatura = [];	  	
	  	$construtora = Construtora::find($id);
      	
    	$endereco = $construtora->endereco;
      
  		if ($endereco) {
      		$estado_id = $endereco->cidade->estado->id;
      		$bairro = $endereco->bairro;

	      	$dadosEndereco = [
	      	  'logradouro' => $endereco->logradouro,
	      	  'complemento' => $endereco->complemento,
	      	  'numero' => $endereco->numero,
	      	  'cep' => $endereco->cep,
	      	  'cidade_id' => $endereco->cidade_id,
	      	  'estado_id' => $estado_id,
	      	  'bairro_id' => $bairro->id,
	      	];
      	}

  		$assinatura = $construtora->assinatura->first();

      	if ($assinatura) {
	      	$dadosAssinatura = [
	      	  'assinatura_id' => $assinatura->pivot->assinatura_id,
	      	];
      	}

      	$dados = array_merge($dadosEndereco, $dadosAssinatura);

      	Session::flashInput($dados);
    }

    public function update(UpdateRequest $request)
    {        
      	DB::beginTransaction();
        
        $redirect_location = parent::updateCrud($request);

        $construtora = Construtora::find($this->crud->entry->id);

        $construtora->atualizarRelacionamentos($request);

        DB::commit();

      	return $redirect_location;      	
    }
}
