<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AssinaturaRequest as StoreRequest;
use App\Http\Requests\AssinaturaRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Models\Assinatura;

/**
 * Class AssinaturaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AssinaturaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Assinatura');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/assinatura');
        $this->crud->setEntityNameStrings('assinatura', 'assinaturas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        $this->crud->addColumn([
            'name' => 'nome',
            'label' => "Nome"
        ]);

        $this->crud->addColumn([
            'name' => 'preco',
            'label' => "Preço"
        ]);

        $this->crud->addField([
           'label' => "Nome do plano",
           'type' => 'text',
           'name' => 'nome',
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Tipo",
           'type' => 'enum',
           'name' => 'tipo',
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Quantidade de produtos",
           'type' => 'text',
           'name' => 'quantidade_produtos',
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Preço",
           'type' => 'text',
           'name' => 'preco',
           'attributes' => ['class' => 'form-control moeda'],
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Preço Desconto",
           'type' => 'text',
           'name' => 'preco_desconto',
           'attributes' => ['class' => 'form-control moeda'],
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Valor adicional por empreendimento",
           'type' => 'text',
           'name' => 'valor_adicional',
           'attributes' => ['class' => 'form-control moeda'],
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);

        $this->crud->addField([
           'label' => "Período bônus (dias)",
           'type' => 'number',
           'name' => 'periodo_bonus',
           'attributes' => ['class' => 'form-control'],
           'wrapperAttributes' => [
                'class' => 'col-md-6'
            ]
        ]);


        // add asterisk for fields that are required in AssinaturaRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
  		$redirect_location = parent::updateCrud($request);
  		return $redirect_location;
    }
}
