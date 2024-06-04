<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use Backpack\PermissionManager\app\Http\Requests\UserStoreCrudRequest as StoreRequest;
use Backpack\PermissionManager\app\Http\Requests\UserUpdateCrudRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Backpack\PermissionManager\app\Http\Controllers\UserCrudController as BackpackUserCrudController;
use App\Models\BackpackUser;
use App\Models\Construtora;
use Illuminate\Support\Facades\DB;

/**
 * Class AssinaturaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class UserCrudController extends BackpackUserCrudController
{
	public function setup()
	{
	    /*
	    |--------------------------------------------------------------------------
	    | BASIC CRUD INFORMATION
	    |--------------------------------------------------------------------------
	    */
	    $this->crud->setModel(config('backpack.permissionmanager.models.user'));
	    $this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
	    $this->crud->setRoute(backpack_url('user'));

	    // Columns.
	    $this->crud->setColumns([
	        [
	            'name'  => 'name',
	            'label' => 'Nome',
	            'type'  => 'text',
	        ],
	        [
	            'name'  => 'email',
	            'label' => 'E-mail',
	            'type'  => 'email',
	        ],
	        [ 
	           'label'     => 'Acesso', // Table column heading
	           'type'      => 'select_multiple',
	           'name'      => 'roles', // the method that defines the relationship in your Model
	           'entity'    => 'roles', // the method that defines the relationship in your Model
	           'attribute' => 'name', // foreign key attribute that is shown to user
	           'model'     => config('permission.models.role'), // foreign key model
	        ],
	        [ 
           		'type' => 'select',
	        	'label' => 'Construtora',
	        	'name' => 'construtora_id', 
	        	'entity' => 'construtora', 
	        	'attribute' => 'nome',
	        ]
	    ]);

	    // Fields
	    $this->crud->addFields([
	        [
	            'name'  => 'name',
	            'label' => trans('backpack::permissionmanager.name'),
	            'type'  => 'text',
	        ],
	        [
	            'name'  => 'email',
	            'label' => trans('backpack::permissionmanager.email'),
	            'type'  => 'email',
	        ],
	        [
	            'name'  => 'data_nascimento',
	            'label' => trans('backpack::base.data_nascimento'),
	            'type'  => 'text',
	            'attributes' => ['class' => 'form-control date']
	        ],	        
	        [
	        	'type' => 'select2',
	        	'placeholder' => 'Selecione a construtora',
	        	'label' => 'Construtora',
	        	'name' => 'construtora_id', // the relationship name in your Model
	        	'entity' => 'construtora', // the relationship name in your Model
	        	'attribute' => 'nome', // attribute on Article that is shown to admin
	        	'options'   => (function ($query) {
	        	    return $query->where('status', 'Liberada')->where('nome', '<>', '')->get();  
	        	}),
	        ],
	        [
	            'name'  => 'password',
	            'label' => trans('backpack::permissionmanager.password'),
	            'type'  => 'password',
	        ],
	        [
	            'name'  => 'password_confirmation',
	            'label' => trans('backpack::permissionmanager.password_confirmation'),
	            'type'  => 'password',
	        ],
	        [
		        'label' => "Foto",
		        'name' => "foto",
		        'filename' => "foto",
		        'type' => 'image',
		        'crop' => true
    	    ],
	        [
	        // two interconnected entities
	        'label'             => trans('backpack::permissionmanager.user_role_permission'),
	        'field_unique_name' => 'user_role_permission',
	        'type'              => 'checklist_dependency',
	        'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
	        'subfields'         => [
	                'primary' => [
	                    'label'            => trans('backpack::permissionmanager.roles'),
	                    'name'             => 'roles', // the method that defines the relationship in your Model
	                    'entity'           => 'roles', // the method that defines the relationship in your Model
	                    'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
	                    'attribute'        => 'name', // foreign key attribute that is shown to user
	                    'model'            => config('permission.models.role'), // foreign key model
	                    'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
	                    'number_columns'   => 3, //can be 1,2,3,4,6
	                ],
	                'secondary' => [
	                    'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
	                    'name'           => 'permissions', // the method that defines the relationship in your Model
	                    'entity'         => 'permissions', // the method that defines the relationship in your Model
	                    'entity_primary' => 'roles', // the method that defines the relationship in your Model
	                    'attribute'      => 'name', // foreign key attribute that is shown to user
	                    'model'          => config('permission.models.permission'), // foreign key model
	                    'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
	                    'number_columns' => 3, //can be 1,2,3,4,6
	                ],
	            ],
	        ],
	    ]);
	}
	
	public function store(StoreRequest $request)
	{
	    try {
	        DB::beginTransaction();

	        $this->handlePasswordInput($request);

	        $retorno = parent::storeCrud($request);

	        $id = $this->crud->entry->id;

	        (new BackpackUser())->acoesAposInserir($request, $id);

	        DB::commit();
	        
	        return $retorno;
	        
	    } catch (\Exception $e) {
	        DB::rollback();
	        return $e->getMessage();
	    }
	}

	public function update(UpdateRequest $request)
	{	    	    
		$this->handlePasswordInput($request);

	    $redirect_location = parent::updateCrud($request);

	    $id = $this->crud->entry->id;

	    (new BackpackUser())->acoesAposInserir($request, $id);

	    return $redirect_location;
	}

	public function restore($id)
	{	    	    
		BackpackUser::onlyTrashed()->where('id', $id)->restore();
		echo "Usuário Restaurado!";
	}
}
