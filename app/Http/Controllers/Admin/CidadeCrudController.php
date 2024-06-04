<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CidadeRequest as StoreRequest;
use App\Http\Requests\CidadeRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class CidadeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CidadeCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Cidade');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/cidade');
        $this->crud->setEntityNameStrings('cidade', 'cidades');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        //$this->crud->setFromDb();

        $this->crud->addColumn([
            'type' => 'select',
            'placeholder' => 'Selecione o Estado',
            'label' => 'Estado',
            'name' => 'estado_id', // the relationship name in your Model
            'entity' => 'estado', // the relationship name in your Model
            'attribute' => 'nome', // attribute on Article that is shown to admin

        ]);

        $this->crud->addField([
            'type' => 'select2',
            'placeholder' => 'Selecione o Estado',
            'label' => 'Estado',
            'name' => 'estado_id', // the relationship name in your Model
            'entity' => 'estado', // the relationship name in your Model
            'attribute' => 'nome', // attribute on Article that is shown to admin

            // optional
            'options'   => (function ($query) {
                return $query->orderBy('nome', 'ASC')->get();
            }), // force the related options to be a custom query, instead of all(); you can use this to filter the results show in the select
        ]);

        $this->crud->addField([
            'name' => 'nome',
            'label' => "Nome da Cidade",
            'type' => 'text',           
        ]);

        $this->crud->addColumn([
            'name' => 'nome',
            'label' => "Nome da Cidade",
            'type' => 'text',           
        ]);

        // add asterisk for fields that are required in CidadeRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
