<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin'
], function () { // custom admin routes
	//Route::get('admin/user', 'UserCrudController@index');
    CRUD::resource('construtora', 'ConstrutoraCrudController');
    CRUD::resource('assinatura', 'AssinaturaCrudController');
    CRUD::resource('modalidade', 'ModalidadeCrudController');
    CRUD::resource('tipoconstrutora', 'TipoconstrutoraCrudController');
    CRUD::resource('caracteristica', 'CaracteristicaCrudController');
    CRUD::resource('estado', 'EstadoCrudController');
    CRUD::resource('cidade', 'CidadeCrudController');
    CRUD::resource('bairro', 'BairroCrudController');
}); // this should be the absolute last line of this file