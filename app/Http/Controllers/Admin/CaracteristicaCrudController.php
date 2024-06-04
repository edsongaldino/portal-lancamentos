<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CaracteristicaRequest as StoreRequest;
use App\Http\Requests\CaracteristicaRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use App\Models\Caracteristica;

/**
 * Class CaracteristicaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CaracteristicaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Caracteristica');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/caracteristica');
        $this->crud->setEntityNameStrings('caracteristica', 'caracteristicas');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->addColumn([
            'name' => 'nome',
            'label' => 'Característica',
        ]);

        $this->crud->addColumn([
            'name' => 'tipo',
            'label' => 'Tipo',
        ]);

        // CRUD

        $this->crud->addField([
            'name' => 'nome',
            'label' => 'Característica',
        ]);

        $this->crud->addField([
            'name' => 'tipo',
            'label' => 'Tipo',
            'type' => 'enum'
        ]);

        $this->crud->addField([
            'name' => 'icone',
            'label' => 'Icone',
        ]);

        $this->crud->addField([
            'name' => 'exibir',
            'label' => 'Exibir?',
            'type' => 'enum'
        ]);

        // add asterisk for fields that are required in CaracteristicaRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {        
        $redirect_location = parent::storeCrud($request);
        
        $icone_valor = (new Caracteristica())->uploadIcone($request);        
        
        if ($icone_valor) {
            $caracteristica = Caracteristica::find($this->entry->id);
            $caracteristica->icone_valor = $icone_valor;
            $caracteristica->save();    
        }

        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        
        $icone_valor = (new Caracteristica())->uploadIcone($request);        
        
        if ($icone_valor) {
            $caracteristica = Caracteristica::find($this->entry->id);
            $caracteristica->icone_valor = $icone_valor;
            $caracteristica->save();    
        }

        return $redirect_location;
    }
}
